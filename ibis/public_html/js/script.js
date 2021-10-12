

window.onload = setup;



function setup() {
    //event listeneri za modale
    enableModals();

    //event listeneri za sliku
    //koristi se timeout da bi se dozvolilo animaciji
    //da se završi do kraja prije nego što korisnik klikne
    let images = document.getElementsByClassName('slide');
    setTimeout(() => {
        enableEventListeners(images);
    }, 1000);

    //event listeneri za signup i login forme
    enableLoginListener();
    enableSignUpListener();

    //gašenje spinnera
    disableOverlay();


    //ne dozvoljava da se pojavi popup vezan za form submission prilikom refresha
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

function disableOverlay() {
    //timeout postoji zbog zahtjeva da se spiner ugasi 
    //tek sekund i po nakon učitavanja stranice
    let overlay = document.getElementsByClassName('spinnerContainer')[0];
    setTimeout(() => {
        overlay.style.opacity = '0';
    }, 1200);
    setTimeout(() => {
        overlay.style.display = 'none';
    }, 1500);

}

var currentIndex = 0; //indeks slike
function switchImage() {


    let images = document.getElementsByClassName('slide');
    //isključimo event listenere da korisnik 
    //ne bi pokretao animaciju dok se prethodna ne završi
    disableEventListeners(images);

    images[currentIndex].className = 'slide temporaryImage';

    //nakon što je gotova tranzicija iz mainImage u temporaryImage
    //podešavamo novu sliku
    setTimeout(() => {

        images[currentIndex].className = 'slide invisibleImage';
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].className = 'slide mainImage';

        //dozvoljavamo ponovno mijenjanje slike tek nakon što je 
        //čitava radnja završena
        setTimeout(() => {
            enableEventListeners(images);
        }, 1000);

    }, 1000);
}

function enableEventListeners(images) {
    //uklanjamo event listenere za nevidljive slike
    Array.from(images).forEach(img => {
        if (img.className == 'slide invisibleImage') {
            img.removeEventListener('click', switchImage);
        } else {
            img.addEventListener('click', switchImage);
        }
    });
}

function disableEventListeners(images) {
    //uklanjamo event listenere za sve slike da korisnik ne bi mogao
    //prekinuti animaciju dok ona traje
    Array.from(images).forEach(img => {
        img.removeEventListener('click', switchImage);
    });
}



function enableModals() {

    //uključujemo event listenere za modale
    let closeButtons = document.getElementsByClassName('close');
    for (let index = 0; index < closeButtons.length; index++) {
        closeButtons[index].onclick = () => {
            closeModal();
        };

    }

    let buttons = document.getElementsByClassName('imgButton');
    for (let index = 0; index < buttons.length; index++) {
        buttons[index].onclick = () => {
            openModal(index);
        };
    }

}

function openModal(index) {

    //moramo provjeriti da li je prethodni modal zatvoren u potpunosti
    //nakon što se modal zatvori zbog animacije on ostaje aktivan još neko vrijeme
    let openedModals = document.getElementsByClassName('modal-visible').length;
    if (openedModals != 0) {
        //ukoliko nije prisilno ga zatvaramo
        forceModalClose();

    }
    let modals = document.getElementsByClassName('modal');
    let modal = modals[index];
    modal.className = 'modal-visible';
    preventScrolling();


}

function closeModal() {
    let modal = document.getElementsByClassName('modal-visible')[0];
    animateModalClosing(modal);
}

var currentScroll;
function preventScrolling() {
    //kada se pozicija body elemnta postavi na fiksnu on se scrolla na vrh
    //to izbjegavamo narednom radnjom
    //pamtimo poziciju scrolla da kada vratimo mogućnost skrolanja možemo
    //podesiti poziciju scrolla
    currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    document.body.style = "position: fixed; overflow-y:scroll;";
    document.body.style.top = '-' + currentScroll + 'px';
}

function enableScrolling() {
    document.body.style = "position: static; overflow-y: auto;";
    window.scrollTo(0, currentScroll);
}

//animacija zatvaranja modala
//pamtimo timeout da bi mogli odraditi force-Close
var timeout;
function animateModalClosing(modal) {
    modal.style.top = '-1200px';
    modal.style.backdropFilter = 'blur(0px)';
    enableScrolling();
    timeout = setTimeout(() => {
        modal.className = 'modal';
        modal.style.top = '0px';
        modal.style.backdropFilter = 'blur(5px)';
    }, 1000);
}

function forceModalClose() {
    clearTimeout(timeout);
    enableScrolling();
    let visibleModal = document.getElementsByClassName('modal-visible')[0];
    visibleModal.className = 'modal';
    visibleModal.style.top = '0px';
    visibleModal.style.backdropFilter = 'blur(5px)';
}

function enableLoginListener() {
    //moramo imati dva listenera
    //jedan za login, drugi da spriječi skrolanje stranice na vrh
    //skrolanje se pojavljuje jer je href forme #
    let form = document.getElementById('login');
    if (form !== null) {
        form.removeEventListener('submit', preventSubmit);
        form.addEventListener('submit', login);
    }
}

function disableLoginListener() {
    let form = document.getElementById('login');
    if (form !== null) {
        form.removeEventListener('submit', login);
        form.addEventListener('submit', preventSubmit);
    }
}

function preventSubmit(event) {
    event.preventDefault();
}

function login(event) {

    //blokiramo skrolanje
    event.preventDefault();
    disableLoginListener();
    showSpinnerAnimation('loginSpinner');

    let form = document.getElementById('login');
    let data = new FormData(form);
    let email = data.get('email');
    let password = data.get('password');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php');
    xhr.send(data);

    xhr.onreadystatechange = function () {
        let DONE = 4;
        let OK = 200;
        if (xhr.readyState === DONE && xhr.status === OK) {

            //timeout koristimo zbog vizuelnog efekta
            //na lokalnoj mašini je latencija sa serverom minimalna
            //pa se ne bi spinner vidio na ekranu
            setTimeout(() => {
                //upisujemo poruku koju je server poslao
                form.insertAdjacentHTML('afterend', xhr.responseText);
                stopSpinnerAnimation('loginSpinner');

                if (xhr.responseText.includes('Welcome')) {
                    setTimeout(() => {
                        //server je poslao cookie i sve što je potrebno da korisnik
                        //vidi stranicu je da je ponovo učita
                        location.reload();
                    }, 1000);
                } else {
                    enableLoginListener();
                }

            }, 1000);


        }
    };

}

//pošto imamo više spinnera (glavni, login, singup)
//pomoću id-a ih razlikujemo
//takođe brišemo sve poruke od prije
function showSpinnerAnimation(id) {
    let messages = document.getElementsByClassName('invalid');
    Array.from(messages).forEach(element => {
        element.remove();
    });

    messages = document.getElementsByClassName('valid');
    Array.from(messages).forEach(element => {
        element.remove();
    });

    let spinner = document.getElementById(id);
    spinner.style.display = 'block';
}

function stopSpinnerAnimation(id) {
    let spinner = document.getElementById(id);
    spinner.style.display = 'none';
}

function logOut() {
    //dovoljno je izbrisati cookie i refreshati stranicu
    document.cookie = 'token= ;';
    location.reload();
}


//isto kao i za loginListener
function enableSignUpListener() {
    let form = document.getElementById('signup');
    if (form !== null) {
        form.removeEventListener('submit', preventSubmit);
        form.addEventListener('submit', signUp);
    }
}

function disableSignUpListener() {
    let form = document.getElementById('signup');
    if (form !== null) {
        form.removeEventListener('submit', signUp);
        form.addEventListener('submit', preventSubmit);
    }
}

function signUp(event) {

    event.preventDefault();
    disableSignUpListener();
    showSpinnerAnimation('signupSpinner');

    let form = document.getElementById('signup');
    let data = new FormData(form);


    let fname = data.get('firstName');
    let sname = data.get('secondName');
    let email = data.get('email');
    let password = data.get('password');
    let confirmedPassword = data.get('password-confirm');

    if (password !== confirmedPassword) {
        form.insertAdjacentHTML('afterend', '<p class="invalid">Passwords do not match!</p>');
        stopSpinnerAnimation('signupSpinner');
        enableSignUpListener();
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'signup.php');
    xhr.send(data);

    xhr.onreadystatechange = function () {
        let DONE = 4;
        let OK = 200;
        if (xhr.readyState === DONE && xhr.status === OK) {

            setTimeout(() => {
                form.insertAdjacentHTML('afterend', xhr.responseText);
                stopSpinnerAnimation('signupSpinner');
                enableSignUpListener();
            }, 1000);


        }
    };

}

