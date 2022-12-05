const book = document.querySelector('#book');  // holds element with with book id
const appointementForm = document.querySelector('.appointment') // holds form element with appointment class
const wrapper = document.querySelector('.wrapper'); // holds element with wrapper class
const close = document.querySelector('.close'); // holds element with close class

book.addEventListener('click', () =>{ // event listerner for book button
    appointementForm.classList.add('active'); // makes the booking form visible
    wrapper.classList.add('inactive'); // and makes the body less opacity
})
close.addEventListener('click',() => { // form close button listerner
    appointementForm.classList.remove('active'); // makes the booking form pop up hide
    wrapper.classList.remove('inactive'); // makes the body highly visible
})



const bookingForm = document.querySelector('#form'); 
    bookingForm.addEventListener('submit',(e)=>{ // event listener for the booking form submission
        e.preventDefault(); // prevent page refresh
        const date = document.querySelector('#date'); // hold appointment date element
        const time = document.querySelector('#time'); // hold appointment time element
        const service = document.querySelector('#service_choice'); // hold service element

        bookAppointment(user,date,time,service);// invoke bookingappointment function to book appointment
        
    })





