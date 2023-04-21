<html>
   <head>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
   </head>
   <body>
   	 <table>
          <thead>
            <?php $fields = $rs->list_fields(); ?>
              <tr>
                  <?php foreach ($fields as $field) { ?>
                  <th><?php echo strtoupper(str_replace('_', ' ', $field))?></th>
                  <?php } ?>
              </tr>
          </thead>

          <tbody>
           <?php foreach ($rs->result() as $data) { ?>
              <tr>
              <?php foreach ($fields as $field) { ?>
                  <td><?php echo nl2br($data->$field)?></td>
              <?php } ?>
              </tr>
           <?php } ?>
          </tbody>
      </table>
   </body>
</html>
