
<script>

    function popup() {
        var modal = document.getElementById("myModal");
        var modalii = document.getElementById("modelo");
        modal.style.display = "block";
        modelo.style.width = "40%";

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    function closed() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

</script>
