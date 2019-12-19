<form action="<?= get_site_url(); ?>" type="GET">
    <div class="input-group mb-3">
        <input type="text" name="s" value="<?php the_search_query(); ?>" class="form-control" placeholder="Pesquisar...">
        <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>