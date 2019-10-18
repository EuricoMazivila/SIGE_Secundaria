<!--Scripts -->
<script>
    var t = document.getElementById('tabela'), rIndex;
    var x;

    function popup() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    function closed() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
        t.rows[x].cells[2].innerHTML = document.getElementById('inputVagas').value;
    }

    for (var i = 0; i < t.rows.length; i++) {
        t.rows[i].onclick = function () {
            rIndex = this.rowIndex;
            x = rIndex;
        }
    };
</script>
<script>
    $(function () {
        $('.size').styleddropdown();
    });
</script>