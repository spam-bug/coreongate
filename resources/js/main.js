

var adsWrapper = document.getElementById('adsWrapper');

if (typeof (adsWrapper) != 'undefined' && adsWrapper != null) {
    var counter = 1;
    var mLeft = 0
    var radio = document.getElementsByClassName('radio');
    var first = document.getElementById('first')

    setInterval(function () {
        document.getElementById('radio' + counter).checked = true;

        if (document.getElementById('radio' + counter).checked == true) {
            first.style.marginLeft =  mLeft + "px";
        }
        
        counter++;
        mLeft = mLeft - 500;
        if (counter > radio.length) {
            counter = 1;
            mLeft = 0;
        }
        
        

    }, 5000); 
}

var signupForm = document.getElementById('signupForm');
var signUp = document.getElementById('signUp');

if (typeof (signUp) != 'undefined' && signUp != null) {
    
    var cancelButton = document.getElementById('cancel');

    signUp.addEventListener('click', function () {
        signupForm.classList.add('active')
    });
    
    cancelButton.addEventListener('click', function () {
        signupForm.classList.remove('active');
        signupForm.addEventListener('submit', function (event) { 
            event.preventDefault();
        });
        
    });
}

if (typeof (signupForm) != 'undefined' && signupForm != null) {
    
    var cancelButton = document.getElementById('cancel');

    var hasError = signupForm.getAttribute('data');

    if (hasError != '' && hasError != null) {
        signupForm.classList.add('active');
    }
    
    cancelButton.addEventListener('click', function () {
        
        window.location.replace(window.location.pathname + window.location.search + window.location.hash);
    });
}


var alertMessage = document.getElementById('alert');
if (typeof (alertMessage) != 'undefined' && alertMessage != null) {

    document.getElementById('ok').addEventListener('click', function () {
        alertMessage.remove();
    })
}


var numberInput = document.querySelectorAll('input[type="number"]');

if (numberInput.length > 0) {
    Object.keys(numberInput).forEach(function(key) {
        numberInput[key].addEventListener('keypress', function (evt) {
             if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                {
                    evt.preventDefault()
                }
        });
    });
}

var unlimitedTime = document.getElementById('unlimitedTime');
if (typeof (unlimitedTime) != 'undefined' && unlimitedTime != null) {
    unlimitedTime.addEventListener('change', function () {
        var hours = document.getElementById('hours');
        var minutes = document.getElementById('minutes');

        if (hours.getAttribute('disabled') == 'disabled') {
            hours.removeAttribute('disabled');
        } else {
            hours.setAttribute('disabled', 'disabled');
        }

        if (minutes.getAttribute('disabled') == 'disabled') {
            minutes.removeAttribute('disabled');
        } else {
            minutes.setAttribute('disabled', 'disabled');
        }
    });
}

var noExpiration = document.getElementById('noExpiration');
if (typeof (unlimitedTime) != 'undefined' && unlimitedTime != null) {
    noExpiration.addEventListener('change', function () {
        var expiration = document.getElementById('expiration');

        if (expiration.getAttribute('disabled') == 'disabled') {
            expiration.removeAttribute('disabled');
        } else {
            expiration.setAttribute('disabled', 'disabled');
        }
    });
}

var planEditForm = document.getElementById('planEditForm');
if (typeof (planEditForm) != 'undefined' && planEditForm != null) {
    if (noExpiration.checked) {
        expiration.setAttribute('disabled', 'disabled');
    }

    if (unlimitedTime.checked) {
        hours.setAttribute('disabled', 'disabled');
        minutes.setAttribute('disabled', 'disabled');
    }
}


var adsCreate = document.getElementById('adsCreate');
if (typeof (adsCreate) != 'undefined' && adsCreate != null) {
    adsCreate.addEventListener('click', function (event) {
        event.preventDefault()

        document.getElementById('imgUpload').click();
    })

    document.getElementById('imgUpload').addEventListener('change', function () {
        this.closest('form').submit();
    });
}

