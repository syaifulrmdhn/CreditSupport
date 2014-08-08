<h3>Tambah Rule</h3>
<form action="<?php echo base_url();?>admin/spk/create_rule" method="POST"> 
<input type="hidden" name="id_atribut" value="<?=$id_atribut?>">
<table class="table table-bordered" id="rule">
    <thead>
        <?php
        $value_atr = explode(',', $atribut->atribut);
        $count = count($value_atr);
        foreach($value_atr as $value){
            echo '<th>'.htmlentities($pertanyaan[$value]).'</th>';
        }
        ?>
    <th>Kredit Disetujui</th>
    </thead>
    <tbody>
        <?php
        if($rule != null){
            foreach($rule as $field){
            $rule_explode = explode(',', $field->rule);
            echo '<tr>';
                for($i=0;$i<$count;$i++){
                    echo '<td>';
                    echo $rule_explode[$i];
                    echo '</td>';
                }
            echo '<td>'.$field->result.'</td>';
            echo '</tr>';
        }
        }else{
            echo '';
        }
        ?>
        
        <tr>
        <?php
        for($i=0;$i<$count;$i++){
            echo '<td>
                <input type="text" name="rules[1][]" class="input-small">
                </td>';
        }
        ?>
        <td><input type="text" name="result[1]" class="input-small"></td>
        </tr>
    </tbody>
</table>
    <a onclick="tambah_field('<?php echo $count;?>')" class="btn">Tambah Field</a>
    <button type="submit" class="btn btn-primary">Simpan Rule</button>
</form>
<script>
    
    function tambah_field(count){
        var tot = count;
        var html = '<tr>';
        var i;
        if(typeof tambah_field.counter == 'undefined')
            tambah_field.counter = 2;
        
        for(i=0;i<tot;i++){
            html += '<td>'
                +'<input type="text" name="rules['+tambah_field.counter+'][]" class="input-small">'
                +'</td>';
        }
        html += '<td><input type="text" name="result['+tambah_field.counter+']" class="input-small"></td></tr>';
        $("#rule").append(html);
        tambah_field.counter++;
    }
</script>