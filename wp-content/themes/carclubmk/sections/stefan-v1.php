<?php

$cards = array(
    array( 
        'img' => 'person1.jpg',
        'title' => 'Aurora Frost',
        'desc' => 'Being part of a CarClubMK is like having a second family who shares your passion for automobiles. Its amazing how bonds can form over a shared love for horsepower and sleek designs.',
        'color' => '#06C90D'
    ),
    array(
        'img' => "person2.jpg",
        'title' => 'Jackson Steele',
        'desc' => 'Joining a CarClubMK broadens my auto knowledge. Discussing engine mods and restoration tips with enthusiasts offers endless learning opportunities.',
        'color' => '#06A2C9'
    ),
    array(
        'img' => 'person3.jpg',
        'title' => 'Lily Evergreen',
        'desc' => 'CarClubMK camaraderie is unmatched. Road trips and Car shows bond us, creating unforgettable memories centered on our shared passion for automobiles.',
        'color' => '#8F06C9'
    ),
    array(
        'img' => 'person4.jpg',
        'title' => 'Xavier Wolfe',
        'desc' => 'Car clubs ignite camaraderie, fueling our shared love for automobiles through knowledge exchange, unforgettable road trips, and unforgettable memories on wheels.',
        'color' => '#C90678'
    ),
); ?>

<section class="cards_parent">
    <section class="cards_child">
        <div class="c-cards">

            <?php foreach( $cards as $card ):    

                $img = $card['img'];
                $title = $card['title'];
                $desc = $card['desc'];
                $color = $card['color']; ?>
                
                <div class="c-cards_main">

                    <div class="c-cards_img_container" style="--color: <?php echo $color ?>;">
                        <img src="<?php echo get_template_directory_uri() . "/assets/img/" . $card['img']; ?>" alt="<?php echo $card['title']; ?>"/>
                    </div>

                    <div class="c-cards_title">
                        <h1>
                            <?php echo $card['title']; ?>
                        </h1>
                    </div>

                    <div class="c-cards_text">
                        <p>
                            <?php echo $card['desc']; ?>
                        </p>
                    </div>

                    <div class="c-cards_button">
                        <button class="button">Show more</button>
                    </div>

                </div>

            <?php endforeach; ?>
        
        </div>
    </section>
</section>