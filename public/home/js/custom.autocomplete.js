
function autocomplete(inp, ele_id) {
    
    var cl = $('#' + ele_id).attr('data-tbl');
    var currentFocus;
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $('#'+ele_id).attr('data-search'),
            data: {q: val},
            success:function(response) {
                res = JSON.parse(response).items;
                for (i = 0; i < res.length; i++) {

                b = document.createElement("DIV");
                b.innerHTML += res[i].title;
                b.innerHTML += "<input type='hidden' value='" + res[i].title + "' id='"+ res[i].typ +"'>";
                b.addEventListener("click", function(e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    $('#'+ele_id).val(this.getElementsByTagName("input")[0].id);
                    closeAllLists();
                    saveLocation(this.getElementsByTagName("input")[0].id, cl);
                });
                a.appendChild(b);
                }
            }
        });
    });
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) { //up
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
            if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
        }
        }
    }

    function saveLocation(region_id, cl) {
        
        $.ajax({
            type:'POST',
            url: $('#' + ele_id).attr('data-url'),
            data: {"_token": $('meta[name="csrf-token"]').attr('content'), location_id: region_id, tbl: cl, media_id: $('#'+ele_id).attr('data-id')},
            success:function(response) {
                // console.log(response);
            }   
        });
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });

}


