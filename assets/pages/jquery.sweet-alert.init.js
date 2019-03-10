
/**
* Theme: SimpleAdmin Template
* Author: Coderthemes
* SweetAlert
*/

!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {

        //Basic
        $('#sa-basic').on('click', function () {
            swal('Any fool can use a computer').catch(swal.noop)
        });

        //A title with a text under
        $('#sa-title').click(function () {
            swal(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
        });

        //Success Message
        $('#sa-success').click(function () {
            swal(
                {
                    title: 'Good job!',
                    text: 'You clicked the button!',
                    type: 'success',
                    confirmButtonColor: '#4fa7f3'
                }
            )
        });

        //Warning Message
        $('.delete-english').click(function () {
            var table = $('#datatable').DataTable();
            var myid = this.id;
            swal({
                title: 'Are you sure?',
                text: "We will erase the monitor & logs associated.\nNo recovery possible.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#23b195',
                cancelButtonColor: '#d57171',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax(
                    {
                        url: 'https://cooptr.com/Monitor/deleteMonitor/',
                        type: 'POST',
                        data: {
                            monitorId: myid
                        }
                    }
                )
                swal(
                    'Deleted!',
                    'Your monitor has been deleted.',
                    'success'
                )
                //table.row($('#'+myid).parents('tr')).remove().draw();
                $('#card'+myid).remove();
            });
        });
        //Warning Message
        $('.delete-french').click(function () {
            var table = $('.table').DataTable();
            var myid = this.id;
            swal({
                title: 'Êtes-vous sûr?',
                text: "Nous allons supprimé le moniteur et tout l'historique associé.\nAucun retour arrière possible.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#23b195',
                cancelButtonColor: '#d57171',
                cancelButtonText:'Annuler',
                confirmButtonText: 'Oui, le supprimer!'
            }).then(function () {
                $.ajax(
                    {
                        url: 'http://localhost:8888/Automonitor/Monitor/deleteMonitor/',
                        type: 'POST',
                        data: {
                            monitorId: myid
                        }
                    }
                )
                swal(
                    'Supprimé!',
                    'Le moniteur vient d\'être supprimé.',
                    'success'
                )
                //table.row($('#'+myid).parents('tr')).remove().draw();
                $('#card'+myid).remove();
            });
        });
        // Delete buttons <li>
        $('.contactlist').on('click', '.deleteButton', function() {
            var myid = this.id;
            $(this).parent('li').animate({opacity: 'toggle', height: 'toggle'}, 300, null, null);
            $.ajax(
                {
                    url: 'http://localhost:8888/Automonitor/Settings/deleteContact/',
                    type: 'POST',
                    data: {
                        contactId: myid
                    }
                }
            )
        });
        //Parameter
        $('#sa-params').click(function () {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
                swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        });

        //Custom Image
        $('#sa-image').click(function () {
            swal({
                title: 'Sweet!',
                text: 'Modal with a custom image.',
                imageUrl: 'https://unsplash.it/400/200',
                imageWidth: 400,
                imageHeight: 200,
                animation: false
            })
        });

        //Auto Close Timer
        $('#sa-close').click(function () {
            swal({
                title: 'Auto close alert!',
                text: 'I will close in 2 seconds.',
                timer: 2000
            }).then(
                function () {
                },
                // handling the promise rejection
                function (dismiss) {
                    if (dismiss === 'timer') {
                        console.log('I was closed by the timer')
                    }
                }
            )
        });

        //custom html alert
        $('#custom-html-alert').click(function () {
            swal({
                title: '<i>HTML</i> <u>example</u>',
                type: 'info',
                html: 'You can use <b>bold text</b>, ' +
                '<a href="//coderthemes.com/">links</a> ' +
                'and other HTML tags',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i>'
            })
        });

        //Custom width padding
        $('#custom-padding-width-alert').click(function () {
            swal({
                title: 'Custom width, padding, background.',
                width: 600,
                padding: 100,
                background: '#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)'
            })
        });



        //chaining modal alert
        $('#chaining-alert').click(function () {
            swal.setDefaults({
                input: 'text',
                confirmButtonText: 'Next &rarr;',
                showCancelButton: true,
                animation: false,
                progressSteps: ['1', '2', '3']
            })

            var steps = [
                {
                    title: 'Question 1',
                    text: 'Chaining swal2 modals is easy'
                },
                'Question 2',
                'Question 3'
            ]

            swal.queue(steps).then(function (result) {
                swal.resetDefaults()
                swal({
                    title: 'All done!',
                    html: 'Your answers: <pre>' +
                    JSON.stringify(result) +
                    '</pre>',
                    confirmButtonText: 'Lovely!',
                    showCancelButton: false
                })
            }, function () {
                swal.resetDefaults()
            })
        });

        //Danger
        $('.dynamic-alert-ping-english').click(function () {
            var monitorid = $(this).data('monitorid');
            swal.queue([{
                title: 'Is it up ?',
                confirmButtonText: 'Send request',
                text: 'Get the current status of your machine',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.get('https://cooptr.com/Check/checkMonitor/'+monitorid+'/')
                            .done(function (data) {
                            var status = 'unknown';
                            var color = 'default';
                            var statuscode = data.http_code.toString();
                            var totaltime = data.total_time.toString();
                            if(statuscode >=200 && statuscode < 300){ status = 'UP'; color='custom';}else{status = 'DOWN'; color='danger';}
                            swal.insertQueueStep({title:'Monitor is <span class="label label-'+color+'">'+status+'</span>', text:'HTTP status code '+statuscode+'<br>Response time : '+totaltime+' seconds.'})
                            resolve()
                        })
                    })
                }
            }])
        });
        
        //Danger
        $('.dynamic-alert-ping-french').click(function () {
            var monitorid = $(this).data('monitorid');
            swal.queue([{
                title: 'Moniteur up?',
                confirmButtonText: 'Tester la disponibilité',
                text: 'Obtenir le statut actuel de votre machine',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.get('https://cooptr.com/Check/checkMonitor/'+monitorid+'/')
                            .done(function (data) {
                            var status = 'unknown';
                            var color = 'default';
                            var statuscode = data.http_code.toString();
                            var totaltime = data.total_time.toString();
                            if(statuscode >=200 && statuscode < 300){ status = 'UP'; color='custom';}else{status = 'DOWN'; color='danger';}
                            swal.insertQueueStep({title:'Le moniteur est <span class="label label-'+color+'">'+status+'</span>', text:'Retour code HTTP '+statuscode+'<br>Temps de réponse : '+totaltime+' secondes.'})
                            resolve()
                        })
                    })
                }
            }])
        });


    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

    //initializing
    function ($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);