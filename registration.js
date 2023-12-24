document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.querySelector('.menu-btn');
    const links = document.querySelector('.links');

    menuBtn.addEventListener('click', function () {
        links.classList.toggle('');
    });

    // Close the menu when a link is clicked
    links.addEventListener('click', function () {
        links.classList.remove('');
    });
});


const selectImage2 = document.querySelector('.select-image');
const inputFile2 = document.querySelector('#file-2');
const imgArea2 = document.querySelector('.img-area-2');

selectImage2.addEventListener('click', function () {
	inputFile2.click();
});

inputFile2.addEventListener('change', function () {
	const image = this.files[0]
	if(image.size < 2000000) {
		const reader = new FileReader();
		reader.onload = ()=> {
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			const imgUrl = reader.result;
			const img = document.createElement('img');
			img.src = imgUrl;
			imgArea2.appendChild(img);
			imgArea2.classList.add('active');
			imgArea2.dataset.img = image.name;
		}
		reader.readAsDataURL(image);
	} else {
		alert("Image size more than 2MB");
	}
});



const selectfile = document.querySelector('.select-resume');
const file = document.querySelector('#resume');
selectfile.addEventListener('click', function () {
	file.click();
});



const btnsubmit = document.querySelector("#submit");

btnsubmit.addEventListener("click", validate, false);
 
function validate(event){
    event.preventDefault();
   
    var photoInput=document.getElementById("file-2").value;
    var nameInput=document.getElementById("fullname").value;
    var ageInput=document.getElementById("age").value;
    var addressInput=document.getElementById("age").value;
    var phoneInput=document.getElementById("phonenb").value;
    var resumeInput=document.getElementById("resume").value;
    var emailInput=document.getElementById("email").value;
    var serviceInput=document.getElementById("servicetype").value;
    var usermale = document.getElementById('radio1').checked;
    var userfemale = document.getElementById('radio2').checked;

    var namecheck = /(^[A-Za-z]{3,16})([ ]{0,1})([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})/;
    var phonecheck = /\d{8}$/;
    var addresscheck = /^[A-Za-z.]{3,30}$/;
    var emailcheck= /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    let errorCount=0;
    if(nameInput==='')
        {
            document.getElementById('nameerror').innerHTML = "**Enter your full name";
            document.getElementById('fullname').style = "border: 2px solid red;";
        }
        else
        {
            if (namecheck.test(nameInput)) 
            {
       
        document.getElementById('nameerror').innerHTML = "";
        document.getElementById('fullname').style = "border: 2px solid black;";
            }
    
            else
             {
        document.getElementById('nameerror').innerHTML = "**invalid name, your name should be at least of two parts";
        document.getElementById('fullname').style = "border: 2px solid red;";
                errorCount++;
             }
        }

        let parseduserage=parseInt(ageInput);

        if(ageInput==='')
        {
            document.getElementById('ageerror').innerHTML = "**Enter your age";
            document.getElementById('age').style = "border: 2px solid red;";
        }
        else
        {
      
                if (parseduserage>=20 && parseduserage<=40) {
                document.getElementById('ageerror').innerHTML = "";
                document.getElementById('age').style = "border: 2px solid gray;";
                } else {
                document.getElementById('ageerror').innerHTML = "**age is invalid, your age should be between 20 and 40";
                document.getElementById('age').style = "border: 2px solid red;";
                        errorCount++;
        
                }
             }

        if (usermale == true || userfemale == true)
         {
            document.getElementById('gndrerror').innerHTML = "";
          }
           else
            {
            document.getElementById('gndrerror').innerHTML = "**select your gender";
                  errorCount++;
    
          }

      
        if(phoneInput==='')
        {
            document.getElementById('phoneerror').innerHTML = "**Enter your phone number";
            document.getElementById('phonenb').style = "border: 2px solid red;";
        }else{
            if (phonecheck.test(phoneInput))
            {
            
                document.getElementById('phoneerror').innerHTML = "";
                document.getElementById('phonenb').style = "border: 2px solid black;";
            }
             else
             {
                document.getElementById('phoneerror').innerHTML = "**invalid phone";
                document.getElementById('phonenb').style = "border: 2px solid red;";
                        errorCount++;
            }
    }
    if(addressInput==='')
    {
        document.getElementById('addresserror').innerHTML = "**Enter your address";
        document.getElementById('address').style = "border: 2px solid red;";
    }
    else
    {
      if (addresscheck.test(addressInput))
       {
       
        document.getElementById('addresserror').innerHTML = "";
        document.getElementById('address').style = "border: 2px solid black;";
      }
       else 
      {
        document.getElementById('addresserror').innerHTML = "**invalid address";
        document.getElementById('address').style = "border: 2px solid red;";
                errorCount++;
      }
    }

    if(emailInput==='')
    {
        document.getElementById('emailerror').innerHTML = "**Enter your email";
        document.getElementById('email').style = "border: 2px solid red;";
    }else{
      if (emailcheck.test(emailInput)) {
       
        document.getElementById('emailerror').innerHTML = "";
        document.getElementById('email').style = "border: 2px solid black;";
      } else {
        document.getElementById('emailerror').innerHTML = "**invalid email";
        document.getElementById('email').style = "border: 2px solid red;";
                errorCount++;
      }
    }

    if(serviceInput==='')
    {
        document.getElementById('serviceerror').innerHTML = "**Enter a service type";
        document.getElementById('servicetype').style = "border: 2px solid red;";
        errorCount++;
    }
    else
    {
        document.getElementById('serviceerror').innerHTML = "";
        document.getElementById('servicetype').style = "border: 2px solid black;";
    }

    var resumeInput = form.querySelector('#resume');
    var allowedResumeFormats = ['.pdf', '.doc', '.docx'];

    // Get the file name from the path
    var fileName = resumeInput.value.split('\\').pop().split('/').pop();

    // Get the file extension
    var fileExtension = fileName.slice((Math.max(0, fileName.lastIndexOf(".")) || Infinity) + 1);

    if (!allowedResumeFormats.includes('.' + fileExtension.toLowerCase())) {
        document.getElementById('resumeerror').innerHTML = "**Please upload a resume in PDF, DOC, or DOCX format.";
        resumeInput.focus();
        return false;
    }

      if(errorCount==0){
        let formObj=document.getElementById("form");
          formObj.submit();
        }
}

function toggleMenu() {
  const menu = document.querySelector('.navbar-two ul');
  menu.classList.toggle('show');
}

const sr = ScrollReveal({
  distance: '60px',
  duration: 2500,
  delay: 400,
  reset: true
});

sr.reveal('.banner-content, .newsletter, .blog-header', {delay: 200, origin: 'left'});
sr.reveal('.featured-left, .featured-right, .blog-card', {delay: 200, origin: 'top'});
