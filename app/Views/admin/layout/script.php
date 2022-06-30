    <!--BOOTSTRAP--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
        if (window.location.href.indexOf("dashboard") != -1){
            document.getElementById('logo-home').src = "/assets/image/logo_home_selected.png";
            document.getElementById("logo-home-text").classList.add("sidebar-text-active");
        }
        if (window.location.href.indexOf("surat/masuk") != -1){
            document.getElementById('logo-sm').src = "/assets/image/logo_surat_selected.png";
            document.getElementById("logo-sm-text").classList.add("sidebar-text-active");
        }
        if (window.location.href.indexOf("surat/keluar") != -1){
            document.getElementById('logo-sk').src = "/assets/image/logo_surat_selected.png";
            document.getElementById("logo-sk-text").classList.add("sidebar-text-active");
        }
        if (window.location.href.indexOf("agenda/surat-masuk") != -1){
            document.getElementById('logo-ag-sm').src = "/assets/image/logo_agenda_selected.png";
            document.getElementById("logo-ag-sm-text").classList.add("sidebar-text-active");
        }
        if (window.location.href.indexOf("agenda/surat-keluar") != -1){
            document.getElementById('logo-ag-sk').src = "/assets/image/logo_agenda_selected.png";
            document.getElementById("logo-ag-sk-text").classList.add("sidebar-text-active");
        }
        if (window.location.href.indexOf("kategori") != -1){
            document.getElementById('logo-kat').src = "/assets/image/logo_kategori_selected.png";
            document.getElementById("logo-kat-text").classList.add("sidebar-text-active");
        }
    </script>
</body>
</html>