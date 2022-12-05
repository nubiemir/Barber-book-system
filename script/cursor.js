// this is to make the cursor appear with circular border
const cursor = document.querySelector('.mouse'); // holds the cursor div with class mouse
window.addEventListener('mousemove',cursorMove); // eventlistener for the mouse movement and inovke function cursorMove
window.addEventListener('mouseover',activeMouse); // eventlistener to check what the mouse is over and invoke function activeMouse

function activeMouse(e){ // a function that manipulates the display of the cursor according to the element the cursor is over
    const target = e.target; // the element the mouse is over(hovering)
    
    if (target.classList.contains('nav-link')){ // if mouse is over the nav bar links
        cursor.classList.add('active-nav'); // add active nave class to the cursor to increase its circular size and change its background
    }else{
        cursor.classList.remove('active-nav'); // when mouse not over nav bar links return to normal
    }
    if (target.classList.contains('services') || target.classList.contains('team') || target.classList.contains('intro')){ // if mouth is over parts document with white body
        cursor.classList.add('active-service'); // change its border color to make it visible
    }else{
        cursor.classList.remove('active-service'); // if not return to normal
    }
}
function cursorMove(e){ // a function that takes the position of the mouse and position the cursor as per the position of the mouse
    cursor.style.top = e.pageY + 'px'; // 
    cursor.style.left = e.pageX + 'px';
}