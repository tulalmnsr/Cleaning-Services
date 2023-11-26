const body=document.querySelector("body"),
    siderbar=body.querySelector(".sidebar"),
    toggle=body.querySelector(".toggle"),
    searchBtn=body.querySelector(".search-box"),
    modeText=body.querySelector(".mode-text"),
    modeSwitch=body.querySelector(".toggle-switch");

    toggle.addEventListener("click", ()=>{
        siderbar.classList.toggle("close");
    }
    );
    searchBtn.addEventListener("click", ()=>{
        siderbar.classList.remove("close");
    }
    );


    modeSwitch.addEventListener("click", ()=>{
        body.classList.toggle("dark");

        if(body.classList.contains("dark")){
            modeText.innerText="light Mode";
        }else{
            modeText.innerText="Dark Mode";
        }
    }
    );

    document.getElementById('textInput').addEventListener('input', function (event) {
        const searchTerm = event.target.value.toLowerCase();
        const listItems = document.querySelectorAll('.atable tr td');
    
        listItems.forEach(function (item) {
            const itemText = item.textContent.toLowerCase();
    
            if (itemText.includes(searchTerm)) {
                item.style.display = 'list-item';
            } else {
                item.style.display = 'none';
            }
        });
    });
    function deleteRow(i) {
        // Get the reference of the button's parent row
        var row = i.parentNode.parentNode;

        // Delete the row
        row.parentNode.removeChild(row);
    }