<div class="container">
<div class="row" >
    <div class="col s12">
        <h5><?php echo isset($search) && $search != "" ? "R&eacute;sultats de recherche pour \"{$search}\"": ''?></h5>
    </div>
</div>
<?php if($routes):?>
<div class="row" >
    <table class="highlight responsive-table">
        <thead>
        <tr>
            <th data-field="nom">Auteur</th>
            <th data-field="nom">Nom</th>
            <th data-field="description">Description</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($routes as $route): ?>
            <tr>
                <td><?php echo $route->author?></td>
                <td><?php echo $route->name?></td>
                <td><?php echo $route->description?></td>
                <td>
                    <form action="<?php echo site_url('edit_mode/readonly')?>" method="POST">
                        <button class="btn waves-effect waves-light" type="submit" name="action" value="Montre moi le chemin">
                            <i class="material-icons left">visibility</i>Montre moi le chemin
                        </button>
                        <input type="hidden" name="id" value="<?php echo $route->id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $route->user_id; ?>">
                    </form>
                </td>
                <td>
                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u=
                        <?php echo urlencode('http://efnpulnold.localtunnel.me/edit_mode/readonly/'.$route->user_id.'/'.$route->id);?>&t=BITCH IM BACK"
                       onclick="javascript:window.open(this.href,  sur '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                       target="_blank" title="Share on Facebook">Partager sur <i class="fa fa-facebook" style="font-size: 18px;"></i>acebook
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
<div class="row" >
    <div class="col s12">
        <h5>Aucun r&eacute;sultat</h5>
    </div>
</div>
<?php endif; ?>
</div>
</div>