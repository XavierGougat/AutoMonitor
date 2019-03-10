<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
    {
        parent::__construct();
        if(!is_logged_in())  // if you add in constructor no need write each function in above controller. 
        {
            redirect('Dashboard');
        }
        $this->output->enable_profiler(FALSE);
        $this->load->database();
        $this->load->model(array('user_model'));
        $this->load->helper('security');
        $this->lang->load('theme', $this->session->userdata('user_profile_lang'));
        $this->lang->load('payment', $this->session->userdata('user_profile_lang'));

        $this->layout->set_titre($this->lang->line("upgrade_title"));
    }

    public function index()
    {
        $this->data['invoiceNumber'] = $this->user_model->countUserPremiumToday();
        $this->layout->view('premium.php', $this->data);
    }

    public function sms()
    {
        $this->layout->set_titre('Add a SMS Pack');
        $this->data['invoiceNumber'] = $this->user_model->countUserPremiumToday();
        $this->layout->view('premium_sms.php', $this->data);  
    }

    public function charge()
    {
        $user = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        $email = $this->session->userdata('user_profile_email');
        try {

            require_once(APPPATH.'libraries/stripe/init.php');

            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $token  = $_POST['stripeToken'];

            if($user[0]->stripeCustomerId==null){// create Customer
                $customer = \Stripe\Customer::create(array(
                    "email" => $email,
                    "source" => $token
                ));
            }else{
                // retrieve Customer
                $customer = \Stripe\Customer::retrieve($user[0]->stripeCustomerId);
            }
            // associate Customer to the Plan
            $subscription = \Stripe\Subscription::create(array(
                "customer" => $customer,
                "plan" => 'am-standard'
            ));

            $userPay = new stdClass();
            $userPay->id = $this->session->userdata('user_profile_id');
            $userPay->premium = 1;
            $userPay->cardName = $_POST['cardName'];
            $userPay->premiumDate = date("Y-m-d H:i:s");
            $userPay->premiumEndDate=date("Y-m-d H:i:s",$subscription['current_period_end']);
            $userPay->stripeCustomerId = $subscription['customer'];
            $userPay->invoiceNumber = $_POST['invoiceNumber'];
            $userPay->cardLast4 = $customer->sources->data[0]->last4;
            $userPay->cardBrand = $customer->sources->data[0]->brand;
            $userPay->smsCount = 10;

            if($userPay->cardBrand=="American Express"){$userPay->cardBrand = "amex";}
            if($userPay->cardBrand=="Diners Club"){$userPay->cardBrand = "diners-club";}

            $userPayArray = array($userPay);
            $this->user_model->updateUser($userPayArray);

            $this->session->set_userdata('user_profile_premium',1);

            $this->session->set_flashdata('messageOK', 'Paiement accepté. Vous êtes maintenant abonné Premium. Vous pouvez consulter vos factures dans votre espace personnel.');
            redirect('Dashboard');
        }
        catch(Stripe_CardError $e) {
            echo $e;
        }
        catch (Stripe_InvalidRequestError $e) {
            echo $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            echo $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            echo $e->getMessage();
        } catch (Stripe_Error $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function chargeSMS()
    {
        $user = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        $email = $this->session->userdata('user_profile_email');
        try {

            require_once(APPPATH.'libraries/stripe/init.php');

            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $token  = $_POST['stripeToken'];

            if($user[0]->stripeCustomerId==null){// create Customer
                $customer = \Stripe\Customer::create(array(
                    "email" => $email,
                    "source" => $token
                ));
            }else{
                // retrieve Customer
                $customer = \Stripe\Customer::retrieve($user[0]->stripeCustomerId);
            }

            // charge customer
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => 400,
                'currency' => 'eur'
            ));

            $this->user_model->addSmsToUser($this->session->userdata('user_profile_id'),'+20');

            $this->session->set_flashdata('messageOK', 'Paiement accepté. Nous avons ajouté 20 sms à votre abonnement.');
            redirect('Dashboard');
        }
        catch(Stripe_CardError $e) {
            echo $e;
        }
        catch (Stripe_InvalidRequestError $e) {
            echo $e->getMessage();
        } catch (Stripe_AuthenticationError $e) {
            echo $e->getMessage();
        } catch (Stripe_ApiConnectionError $e) {
            echo $e->getMessage();
        } catch (Stripe_Error $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }

    function invoices(){
        $user = $this->user_model->findUserById($this->session->userdata('user_profile_id'));
        try {

            require_once(APPPATH.'libraries/stripe/init.php');

            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $invoices = \Stripe\Invoice::all(array("customer" => $user[0]->stripeCustomerId));
            $this->data['invoices'] = $invoices->__toArray(true);

            $subscriptions = \Stripe\Subscription::all(array('customer'=>$user[0]->stripeCustomerId));
            $this->data['subscriptions'] = $subscriptions->__toArray(true);

            $this->layout->view('invoices.php', $this->data);
        }
        catch(Stripe_CardError $e) {

        }
        catch (Stripe_InvalidRequestError $e) {

        } catch (Stripe_AuthenticationError $e) {
        } catch (Stripe_ApiConnectionError $e) {
        } catch (Stripe_Error $e) {
        } catch (Exception $e) {
        }
    }


    public function cancelSubscription()
    {
        $user = $this->user_model->findUserById($this->session->userdata('user_profile_id'));

        try {

            require_once(APPPATH.'libraries/stripe/init.php');

            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $subscriptions = \Stripe\Subscription::all(array('customer'=>$user[0]->stripeCustomerId));
            $this->data['subscriptions'] = $subscriptions->__toArray(true);

            $sub = \Stripe\Subscription::retrieve($this->data['subscriptions']['data'][0]['id']);
            $sub->cancel(array('at_period_end'=>true));

            $userPay = new stdClass();
            $userPay->id = $this->session->userdata('user_profile_id');
            $userPay->premiumDate = date("Y-m-d H:i:s");
            $userPay->premiumEndDate = date("Y-m-d H:i:s",$sub['current_period_end']);

            $userPayArray = array($userPay);
            $this->user_model->updateUser($userPayArray);
            $this->session->set_flashdata('messageOK', 'Abonnement annulé.');
            redirect('Payment/Invoices');
        }
        catch (Stripe_InvalidRequestError $e) {

        } catch (Stripe_AuthenticationError $e) {
        } catch (Stripe_ApiConnectionError $e) {
        } catch (Stripe_Error $e) {
        } catch (Exception $e) {
        }
    }

    public function reactiveSubscription()
    {
        $user = $this->user_model->findUserById($this->session->userdata('user_profile_id'));

        try {

            require_once(APPPATH.'libraries/stripe/init.php');

            $stripe = array(
                "secret_key"      => "sk_test_Ze8mATJOumf3yxkTE3FiC14D",
                "publishable_key" => "pk_test_fs8tzZ7R0LPh5mvNOgdlk0Zu"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $subscriptions = \Stripe\Subscription::all(array('customer'=>$user[0]->stripeCustomerId));
            $this->data['subscriptions'] = $subscriptions->__toArray(true);

            $sub = \Stripe\Subscription::retrieve($this->data['subscriptions']['data'][0]['id']);
            $sub->plan = $this->data['subscriptions']['data'][0]['plan']['id'];
            $sub->save();

            $userPay = new stdClass();
            $userPay->id = $this->session->userdata('user_profile_id');
            $userPay->premium = 1;
            $userPay->premiumDate = date("Y-m-d H:i:s");
            $userPay->premiumEndDate=date("Y-m-d H:i:s",$sub['current_period_end']);

            $userPayArray = array($userPay);
            $this->user_model->updateUser($userPayArray);

            $this->session->set_userdata('user_profile_premium',1);
            $this->session->set_flashdata('messageOK', 'Abonnement ré-activé.');
            redirect('Payment/Invoices');
        }
        catch (Stripe_InvalidRequestError $e) {

        } catch (Stripe_AuthenticationError $e) {
        } catch (Stripe_ApiConnectionError $e) {
        } catch (Stripe_Error $e) {
        } catch (Exception $e) {
        }
    }
}
