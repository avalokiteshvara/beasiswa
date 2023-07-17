<h3 style="text-align: center;"><?php echo $header; ?></h3>

<table aria-describedby="" style="width: 100%; border-collapse: collapse;">
    <thead>
        <?php $fields = $rs->list_fields(); ?>
        <tr>
            <th style="border: 1px solid black; padding: 5px;">No.</th>
            <?php foreach ($fields as $field) { ?>
                <?php if ($field == 'status_penerima_sebelumnya') continue; ?>
                <th style="border: 1px solid black; padding: 5px;"><?php echo strtoupper(str_replace('_', ' ', $field)) ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($rs->result() as $data) { ?>
            <tr>
                <td style="border: 1px solid black; padding: 5px;" align="center"><?php echo $i; ?></td>
                <?php foreach ($fields as $field) { ?>
                    <?php if ($field == 'status_penerima_sebelumnya') continue; ?>
                    <?php if ($data->status_penerima_sebelumnya == '1') { ?>
                        <td style="text-decoration: line-through;border: 1px solid black; padding: 5px;"><?php echo $data->$field !== null ? nl2br($data->$field) : ''; ?></td>
                    <?php } else { ?>
                        <td style="border: 1px solid black; padding: 5px;"><?php echo $data->$field !== null ? nl2br($data->$field) : ''; ?></td>
                    <?php } ?>
                <?php } ?>
                <?php $i++; ?>
            </tr>
        <?php } ?>
    </tbody>
</table>