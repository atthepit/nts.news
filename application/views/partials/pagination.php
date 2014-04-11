        <div class="row">
            <?php
                if($offset == 0) $nuevo_offset = 1;
                else $nuevo_offset = $offset;
                $offset_siguiente = $offset + $limit;
                $offset_anterior  = $offset - $limit;
                $paginas = ($total / $limit) ;
            ?>
            <div class="col-lg-4 col-lg-offset-5">
                <ul class="pagination">
                    <?php if($offset_anterior >= 0) : ?>
                        <li><a href="<?php echo base_url() . 'noticias/' . $categoria . '?offset=' . $offset_anterior . '&limit=' . $limit ?>">&laquo;</a></li>
                    <?php endif ?>
                    <?php for($i = 0; $i < $paginas; $i++): ?>
                        <li><a href="<?php echo base_url() . 'noticias/' . $categoria . '?offset=' . ($i * $limit) . '&limit=' . $limit ?>"><?php echo $i + 1 ?></a></li>
                    <?php endfor ?>
                    <?php if($offset_siguiente < $total) : ?>
                        <li><a href="<?php echo base_url() . 'noticias/' . $categoria . '?offset=' . $offset_siguiente . '&limit=' . $limit ?>">&raquo;</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>