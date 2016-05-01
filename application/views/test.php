    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $("#selection_med").click(function(){
             var medicament = $('#medicament option:selected' ).val();
            $.ajax({
                type:"POST",
                url: "<?php echo site_url('controlleur_principal/medicament_data');?>",
                data:{medicament: medicament},
                success: function (dataCheck) {
                    //alert(dataCheck);
                    $('.sort').html(dataCheck);
                    //window.location.reload();},
                }
            });
        });
    });
    </script>

    <h1> Pharmacopee </h1>
    <select id="medicament">
    <?php
        foreach($result as $data) {
            echo'<option >'.$data->MED_DEPOTLEGAL.'</option>';
        }
    ?>

    </select>

    <input id="selection_med" type="submit" value="Sélectionner"/>
    
    <div id="sidebar">
        <div class="box">
            <div class="box-head">
                <h2>Employee List</h2>
            </div>
            <div class="sort" id="show">
                <br>
            </div>
        </div>
    </div>
