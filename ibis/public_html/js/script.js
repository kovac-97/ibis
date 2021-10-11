

window.onload=setup;



function setup(){  
    enableModals();
    let images=document.getElementsByClassName('slide');
    setTimeout(()=>{
        enableEventListeners(images);
    },1000);
    enableLoginListener();
    enableSignUpListener();
    disableOverlay();

    
    //ne dozvoljava da se pojavi popup vezan za form submission
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

function disableOverlay(){
    let overlay=document.getElementsByClassName('spinnerContainer')[0];
    setTimeout(()=>{
        overlay.style.display='none';
    },1500);
    
}

var currentIndex=0;
function switchImage(){
    
    
    let images=document.getElementsByClassName('slide');
    //isključimo event listenere da korisnik 
    //ne bi pokretao animaciju dok se prethodna ne završi
    disableEventListeners(images);

    images[currentIndex].className='slide temporaryImage';
    
    //nakon što je gotova tranzicija iz mainImage u temporaryImage
    //podešavamo novu sliku
    setTimeout(()=>{

    images[currentIndex].className='slide invisibleImage';
    currentIndex=(currentIndex + 1)%images.length;
    images[currentIndex].className='slide mainImage';
        
    //dozvoljavamo ponovno mijenjanje slike tek nakon što je 
    //čitava radnja završena
    setTimeout( ()=>{
        enableEventListeners(images);
    }, 1000);
    
    },1000);  
}

function enableEventListeners(images){
    Array.from(images).forEach(img => {
        if(img.className=='slide invisibleImage'){
            img.removeEventListener('click', switchImage);
        }else{
            img.addEventListener('click', switchImage);
        }
    });
}

function disableEventListeners(images){
    Array.from(images).forEach(img => {
            img.removeEventListener('click', switchImage);       
    });
}



function enableModals(){

    let closeButtons=document.getElementsByClassName('close');
    for (let index = 0; index < closeButtons.length; index++) {
        closeButtons[index].onclick= ()=>{
            closeModal();
        };
        
    }

    let buttons=document.getElementsByClassName('imgButton');    
    for (let index = 0; index < buttons.length; index++) {
        buttons[index].onclick= ()=>{
            openModal(index);
        };        
    }

}

function openModal(index){

    //moramo provjeriti da li je prethodni modal zatvoren u potpunosti
    let openedModals=document.getElementsByClassName('modal-visible').length;
    if(openedModals!=0){
        //ukoliko nije prisilno ga zatvaramo
        forceModalClose();

    }
        let modals=document.getElementsByClassName('modal');
        let modal=modals[index];
        modal.className='modal-visible';
        preventScrolling(); 
    
    
}

function closeModal(){
    let modal=document.getElementsByClassName('modal-visible')[0];
    animateModalClosing(modal);   
}

var currentScroll;
function preventScrolling(){

    currentScroll=document.documentElement.scrollTop || document.body.scrollTop;   
    document.body.style="position: fixed; overflow-y:scroll;";
    document.body.style.top='-' + currentScroll + 'px';
   
}

function enableScrolling(){
    
    document.body.style="position: static; overflow-y: auto;";
    window.scrollTo(0,currentScroll);
}

var timeout;
function animateModalClosing(modal){
  
        modal.style.top='-1200px';
        modal.style.backdropFilter='blur(0px)';
        enableScrolling(); 
        timeout=setTimeout(()=>{
                modal.className='modal';
                modal.style.top='0px';
                modal.style.backdropFilter='blur(5px)';                              
        },1000);
}

function forceModalClose(){
    clearTimeout(timeout);
    enableScrolling();
    let visibleModal=document.getElementsByClassName('modal-visible')[0];
    visibleModal.className='modal';
    visibleModal.style.top='0px';
    visibleModal.style.backdropFilter='blur(5px)';
    
}

function enableLoginListener(){
    let form=document.getElementById('login');
    if(form!==null){  
        form.removeEventListener('submit', preventSubmit);    
        form.addEventListener('submit', login);
    }   
}

function disableLoginListener(){
    let form=document.getElementById('login');
    if(form!==null){      
        form.removeEventListener('submit', login);
        form.addEventListener('submit', preventSubmit);
    }   
}

function preventSubmit(event){
    event.preventDefault();
}

function login(event){

    event.preventDefault();
    disableLoginListener();
    showSpinnerAnimation('loginSpinner');
    
    let form=document.getElementById('login');
    let data=new FormData(form);
    let email=data.get('email');
    let password=data.get('password');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php');
    xhr.send(data);
    
    xhr.onreadystatechange = function () {
        let DONE = 4; 
        let OK = 200; 
        if (xhr.readyState === DONE && xhr.status === OK) {
         
            setTimeout(()=>{
            form.insertAdjacentHTML('afterend',xhr.responseText);
            stopSpinnerAnimation('loginSpinner');

            if(xhr.responseText.includes('Welcome')){
                setTimeout(()=>{
                    location.reload();
                },1000);
            }else{
                enableLoginListener();
            }

            },1000);
            
            
        }
      };

}

function showSpinnerAnimation(id){
    let loginMessages=document.getElementsByClassName('invalid');
    Array.from(loginMessages).forEach(element => {
        element.remove();
    });

    loginMessages=document.getElementsByClassName('valid');
    Array.from(loginMessages).forEach(element => {
        element.remove();
    });

    let spinner=document.getElementById(id);
    spinner.style.display='block';
}

function stopSpinnerAnimation(id){
    let spinner=document.getElementById(id);
    spinner.style.display='none';
}

function logOut(){

    document.cookie='token= ;';
    location.reload();
}


function enableSignUpListener(){
    let form=document.getElementById('signup');
    if(form!==null){  
        form.removeEventListener('submit', preventSubmit);    
        form.addEventListener('submit', signUp);
    }   
}

function disableSignUpListener(){
    let form=document.getElementById('signup');
    if(form!==null){      
        form.removeEventListener('submit', signUp);
        form.addEventListener('submit', preventSubmit);
    }   
}

function signUp(event){
   
    event.preventDefault();
    disableSignUpListener();
    showSpinnerAnimation('signupSpinner');
    
    let form=document.getElementById('signup');
    let data=new FormData(form);


    let fname=data.get('firstName');
    let sname=data.get('secondName');
    let email=data.get('email');
    let password=data.get('password');
    let confirmedPassword=data.get('password-confirm');

    if(password!==confirmedPassword){
        alert("Passwords do not match!");
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'signup.php');
    xhr.send(data);
    
    xhr.onreadystatechange = function () {
        let DONE = 4; 
        let OK = 200; 
        if (xhr.readyState === DONE && xhr.status === OK) {
         
            setTimeout(()=>{
            form.insertAdjacentHTML('afterend',xhr.responseText);
            stopSpinnerAnimation('signupSpinner');
            enableSignUpListener();
            },1000);
            
            
        }
      };

}

