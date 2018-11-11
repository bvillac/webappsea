/*jshint browser:true*/

//
// jSessionTimeOut.js
//
// After a set amount of time, a dialog is shown to the user with the option
// to either log out now, or stay connected. If log out now is selected,
// the page is redirected to a logout URL. If stay connected is selected,
// a keep-alive URL is requested through AJAX. If no options is selected
// after another set amount of time, the page is automatically redirected
// to a timeout URL.
//
//
// USAGE
//
//   1. Include jQuery
//   2. Include jQuery UI (for dialog)
//   3. Include jquery.sessionTimeout.js
//   4. Call $.sessionTimeout(); after document ready
//
//
// OPTIONS
//
//   title
//     Title for the dialog.
//     Default: 'Your session is about to expire!'
//
//   message
//     Text shown to user in dialog after warning period.
//     Default: 'Your session is about to expire.'
//
//   stayConnectedBtn
//     Default: 'Stay connected'
//
//   logoutBtn
//     Default: 'Logout'
//
//   keepAliveUrl
//     URL to call through AJAX to keep session alive. This resource should do something innocuous that would keep the session alive, which will depend on your server-side platform.
//     Default: '/keep-alive'
//
//   redirUrl
//     URL to take browser to if no action is take after warning period
//     Default: '/timed-out'
//
//   logoutUrl
//     URL to take browser to if user clicks "Log Out Now"
//     Default: '/log-out'
//
//   warnAfter
//     Time in milliseconds after page is opened until warning dialog is opened
//     Default: 900000 (15 minutes)
//
//   redirAfter
//     Time in milliseconds after page is opened until browser is redirected to redirUrl
//     Default: 1200000 (20 minutes)
//
(function($) {
    jQuery.sessionTimeout = function(options) {
        var defaults = {
            title: 'Your session is about to expire!',
            message: 'Your session is about to expire.',
            keepAliveUrl: '/keep-alive',
            redirUrl: '/timed-out',
            logoutUrl: '/log-out',
            warnAfter: 900000, // 15 minutes
            redirAfter: 1200000, // 20 minutes
        };

        // Extend user-set options over defaults
        var o = defaults, dialogTimer, redirTimer;

        if (options) {
            o = $.extend(defaults, options);
        }
        // Definimos el namespace con la variable $
        $.sessionTimeout = {};
        
        function controlDialogTimer(action) {
            var counter = o.redirAfter - o.warnAfter;
            switch (action) {
                case 'start':
                    // After warning period, show dialog and start redirect timer
                    dialogTimer = setTimeout(function() {
                        var messageGM = new Object();
                        var msg = o.message; 
                        messageGM.wtmessage = msg.replace(/\{time\}/g, " <span id='timeout-countdown'></span>");
                        messageGM.title = o.title;
                        var objAcciones = new Object();
                        objAcciones.id = "btnid2alert";
                        objAcciones.class = "btn-primary clclass praclose";
                        objAcciones.value = objLang.Accept;
                        var objAcciones2 = new Object();
                        objAcciones2.id = "btnid2alert";
                        objAcciones2.class = "btn-primary clclass praclose";
                        objAcciones2.value = objLang.Restart_Session;
                        objAcciones2.callback = "jQuery.sessionTimeout.resetSessionTimeOut";

                        messageGM.acciones = new Array();
                        messageGM.acciones[0] = objAcciones;
                        messageGM.acciones[1] = objAcciones2;
                        messageGM.htmloptions = new Object();
                        messageGM.htmloptions.style = new Object();
                        messageGM.htmloptions.style.width = "450px";
                        printRequestAlert('NO_OK', 'error', messageGM);

                        controlRedirTimer('start');

                        interval = window.setInterval(function() {
                            counter -= 1000; // 1 segundo == 1000 ms
                            tcont = returnDiffToText(counter)
                            $("#timeout-countdown").html(tcont);
                            if (counter <= 1000) {
                                window.clearInterval(interval);
                            }

                        }, 1000);
                    }, o.warnAfter);
                    break;

                case 'stop':
                    clearTimeout(dialogTimer);
                    break;
            }
        }

        function controlRedirTimer(action) {
            switch (action) {
                case 'start':
                    // Dialog has been shown, if no action taken during redir period, redirect
                    redirTimer = setTimeout(function() {
                        var messageGM = new Object();
                        messageGM.wtmessage = objLang.Your_session_has_ended;
                        messageGM.title = objLang.Error;
                        var objAcciones = new Object();
                        objAcciones.id = "btnid2alert";
                        objAcciones.class = "btn-primary clclass praclose";
                        objAcciones.value = objLang.Accept;
                        objAcciones.callback = "jQuery.sessionTimeout.logoutSessionTimeOut";

                        messageGM.acciones = new Array();
                        messageGM.acciones[0] = objAcciones;
                        messageGM.htmloptions = new Object();
                        messageGM.htmloptions.style = new Object();
                        messageGM.htmloptions.style.width = "450px";
                        printRequestAlert('NO_OK', 'error', messageGM);

                    }, o.redirAfter - o.warnAfter);
                    break;

                case 'stop':
                    clearTimeout(redirTimer);
                    break;
            }
        }
        
        $.sessionTimeout.logoutSessionTimeOut = function(){
            window.location = o.logoutUrl;
        }
        
        $.sessionTimeout.resetSessionTimeOut = function(){
            $.ajax({
                type: 'POST',
                url:  o.keepAliveUrl
            });
            // Stop redirect timer and restart warning timer
            controlRedirTimer('stop');
            controlDialogTimer('start');
        }
        $.sessionTimeout.clearSessionTimeOut = function(){
            controlRedirTimer('stop');
            controlDialogTimer('start');
        }
        // Begin warning period
        controlDialogTimer('start');
    };
})(jQuery);


