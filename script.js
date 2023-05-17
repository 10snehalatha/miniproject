/*const header = document.getElementById("header");

const nav = document.createElement("nav");
const ul = document.createElement("ul");

const home = document.createElement("li");
const homeLink = document.createElement("a");
homeLink.href = "home.php";
homeLink.textContent = "Home";
home.appendChild(homeLink);
ul.appendChild(home);

/*const upload = document.createElement("li");
const uploadLink = document.createElement("a");
uploadLink.href = "upload.php";
uploadLink.textContent = "Upload";
upload.appendChild(uploadLink);
ul.appendChild(upload);*/

/*const volunteer = document.createElement("li");
const volunteerLink = document.createElement("a");
volunteerLink.href = "volunteer.html";
volunteerLink.textContent = "Volunteer";
volunteer.appendChild(volunteerLink);
ul.appendChild(volunteer);

const charity = document.createElement("li");
const charityLink = document.createElement("a");
charityLink.href = "charity.php";
charityLink.textContent = "Find a Charity";
charity.appendChild(charityLink);
ul.appendChild(charity);

const contacts = document.createElement("li");
const contactsLink = document.createElement("a");
contactsLink.href = "contacts.html";
contactsLink.textContent = "Contact Us";
contacts.appendChild(contactsLink);
ul.appendChild(contacts);

nav.appendChild(ul);
header.appendChild(nav);*/

const btn=document
   .querySelector('.read-more-btn');
const text=document
   .querySelector('.card__read-more');
const cardHolder=document
   .querySelector('.card-holder');
cardHolder
  .addEventListener('click',e => {
    const current =e.target;
    const isReadMoreBtn = current.className.includes('read-more-btn');
    if(!isReadMoreBtn)
      return;
    const currentText = e.target.parentNode.querySelector('.card__read-more');
    currentText.classList.toggle('card__read-more--open');
    current.textContent = current.textContent.includes('Read More...') ?'Read Less...' : 'Read More...';
  });