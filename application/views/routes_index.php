<div class="container">
    <div id="tables" class="section scrollspy">
        <div class="row" >
            <div class="col s4">
                <h2 class="header">Vos routes</h2>
            </div>
            <div class="col s8" style="text-align: right; margin-top:35px;">
                <a class="waves-effect waves-light btn" href="<?php echo site_url('edit_mode/add')?>">
                    <i class="material-icons left">add_circle_outline</i>Ajouter
                </a>
            </div>            
        </div>
        <div class="row" >
            <table class="highlight responsive-table">
                <thead>
                <tr>
                    <th data-field="nom">Nom</th>
                    <th data-field="description">Description</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($routes as $route): ?>
                    <tr>
                        <td><?php echo $route->name?></td>
                        <td><?php echo $route->description?></td>
                        <td class="col s12">
                            <form action="<?php echo site_url('edit_mode/edit')?>" method="POST" style="float:left;margin: 10px 0 0 0;">
                                <button class="btn waves-effect waves-light" type="submit" name="action" value="Éditer">
                                    <i class="material-icons">mode_edit</i>
                                </button>
                                <input type="hidden" name="id" value="<?php echo $route->id; ?>">
                            </form>
                            <form action="<?php echo site_url('edit_mode/delete')?>" method="POST" style="margin: 10px 0 0 0;">
                                <button class="btn waves-effect waves-light" style="margin-left:10px;" type="submit" name="action" value="Supprimer">
                                    <i class="material-icons">delete</i>
                                </button>
                                <input type="hidden" name="id" value="<?php echo $route->id; ?>">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
