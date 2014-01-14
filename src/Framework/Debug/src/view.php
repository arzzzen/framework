<div style="position:fixed; bottom:0; width:100%; height:40px; box-shadow: 0 0 30px rgba(0,0,0,0.7);">
  <table>
    <tr>
      <td><h3 style="margin-top:10px;">Debug</h3></td>
      <td>
        <span class="label label-primary"><?=static::$list['method']?></span>
        <span class="label label-default"><?=static::$list['path']?></span>
      </td>
      <td><small><?=static::$list['controller']?>::<?=static::$list['action']?></small></td>
    </tr>
  </table>
</div>