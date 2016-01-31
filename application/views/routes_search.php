<div class="container">
<h2>
    Recherchez une route.
</h2>
<nav>
    <div class="nav-wrapper">
        <form method="GET" action="<?php echo site_url('route/index')?>">
            <div class="input-field">
                <input id="search" name="search_string" type="search">
                <label for="search"><i class="material-icons">search</i></label>
                <!-- I've put "red-text" class to emphasize -->
                <i class="material-icons red-text">close</i>
        </form>
    </div>
</nav>
<?php echo isset($search) ? "Votre derniere recherche: {$search}": ''?>
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
                        <?php echo urlencode('http://ogegcwavif.localtunnel.me/edit_mode/readonly/'.$route->user_id.'/'.$route->id);?>&t=BITCH IM BACK"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                       target="_blank" title="Share on Facebook">share
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>
</div>