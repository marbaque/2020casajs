<div class="evento-aside">
    <?php
    $fechai = get_field('fecha_inicio');
    $fechaf = get_field('fecha_final');
    $horai = get_field('hora_inicio');
    $horaf = get_field('hora_final');
    $todoDia = get_field('evento_dia');
    $ubi = get_field('ubicacion');
    $masInfo = get_field('mas_info');
    $textoEnlace = get_field('txt_enlace') ?: 'Más información';
    ?>
    <div class="fechas">
        <?php
        if ($fechai) {
            $inicio = new DateTime(get_field('fecha_inicio', $post->ID));

            if ($fechai) {
                $inicio = strtotime($fechai);
                echo '<div class="fecha">';
                echo '<span class="dia">' . date_i18n("d", $inicio) . '</span>';
                echo '<span class="mes">' . date_i18n("M", $inicio) . '</span>';
                echo '<span class="ano">' . date_i18n("Y", $inicio) . '</span>';
                echo '</div>';
            }

            if ($fechaf) {
                $final = strtotime($fechaf);
                echo '<div class="fecha"> ';
                echo '<span class="dia">' . date_i18n("d", $final) . '</span>';
                echo '<span class="mes">' . date_i18n("M", $final) . '</span>';
                echo '<span class="ano">' . date_i18n("Y", $final) . '</span>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <p class="hora">
        <?php
        if ($todoDia) {
            echo 'Evento de todo el día';
        } else {
            if ($horai) {
                echo '<i class="fa-light fa-timer"></i> ' . $horai;

                if ($horaf) {
                    echo ' - ' . $horaf;
                }
            }
        }
        ?>

    </p>

    <?php
    if ($ubi) {
        echo '<p class="ubicacion"><i class="fa-sharp fa-light fa-location-smile"></i> ' . $ubi . '</p>';
    }
    ?>

    <?php
    if ($masInfo) {
    ?>
        <a class="enlace" href="<?php echo esc_url($masInfo); ?>" target="_blank"><?php echo '<i class="fa-sharp fa-light fa-arrow-up-right-from-square"></i> ' . esc_html($textoEnlace); ?></a>
    <?php
    }

    $terms = get_the_terms(get_the_ID(), 'tipo_evento');

    if ($terms && !is_wp_error($terms)) :

        $term_links = array();
        foreach ($terms as $term) {
            $term_links[] = '<li class="cat"><a href="' . esc_attr(get_term_link($term->slug, 'tipo_evento')) . '">' . __($term->name) . '</a></li>';
        }

        $all_terms = join('', $term_links);

        echo '<ul class="evento-cats">' . __($all_terms) . '</ul>';


    endif;
    ?>


</div>