<?php 
include("../vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.
$ogr_gorevlileri=$baglanti->query("SELECT * FROM ogr_gorevli");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>YOKLAMALAR</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>
<body>
<script>
    var ders_id;
</script>
<div class="container" style="margin: auto; width: 40%;">
<div class="col-md-6" style="margin-top: 50px">
    <div style="width: 500px; margin:0 auto">
        <div class="form-group">
            <select id="first_level" name="first_level[]" class="form-control">
                <option value="0">Öğretim Görevlisi Seçiniz</option>
                <?php
                foreach($ogr_gorevlileri as $row)
                {
                    echo '<option value="'.$row['id'].'">'.$row['ad_soyad'].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <select id="second_level" name="second_level[]" class="form-control">

            </select>
        </div>
        <div class="form-group">
            <select id="third_level" name="third_level[]" class="form-control">

            </select>
        </div>

    </div>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7" id="yoklamalar">

</div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#first_level').multiselect({
            nonSelectedText:'Öğretim Görevlisi Seçiniz',
            buttonWidth:'400px',
            onChange:function(option, checked){
                $('#second_level').html('');
                $('#second_level').multiselect('rebuild');
                var selected = this.$select.val();
                if(selected.length > 0)
                {
                    $.ajax({
                        url:"fetch_second_level_category.php",
                        method:"POST",
                        data:{selected:selected},
                        success:function(data)
                        {
                            $('#second_level').html(data);
                            $('#second_level').multiselect('rebuild');
                        }
                    })
                }

            }
        });

        $('#second_level').multiselect({
            nonSelectedText: 'Ders Seçiniz',
            buttonWidth:'400px',
            onChange:function(option, checked)
            {
                $('#third_level').html('');
                $('#third_level').multiselect('rebuild');
                var selected = this.$select.val();
                window.ders_id=selected;
                if(selected.length > 0)
                {
                    $.ajax({
                        url:"fetch_third_level_category.php",
                        method:"POST",
                        data:{selected:selected},
                        success:function(data)
                        {
                            $('#third_level').html(data);
                            $('#third_level').multiselect('rebuild');
                        }
                    });
                }
            }
        });
        $('#third_level').multiselect({
            nonSelectedText: 'Tarih Seçiniz',
            buttonWidth:'400px',
            onChange:function(option, checked)
            {
                var selected = this.$select.val();
                if(selected.length > 0)
                {
                    $.ajax({
                        url:"load_data.php",
                        method:"POST",
                        data:{selected:selected,ders_id:window.ders_id},
                        success:function(data)
                        {
                            $('#yoklamalar').html(data);
                        }
                    });
                }
            }
        });


    });
</script>