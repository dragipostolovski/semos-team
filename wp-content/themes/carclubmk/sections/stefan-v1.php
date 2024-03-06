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
    );
?>

<style>
/* * {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}
.cards_parent {
  height: 100svh;
  width: 100%;
  display: flex;
  justify-content: center;
}

.cards_child {
  width: 1280px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.c-cards {
    width: 100%;
    display: flex;
    justify-content: space-between;
}
.c-cards_main {
    width: 22.5%;
    max-height: 500px;
    display: flex;
    flex-direction: column;
    align-items:center;
    text-align: center;
    border: 1px solid #ccc;
    box-shadow: 0px 20px 10px #ccc;
    border-radius: 10px;
}
.c-cards_img_container {
    width: 100%;
    padding: 20px 0;
    border-radius: 10px 10px 0 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid #ccc;
    background-color: var(--color);
}
.c-cards_img_container img {
    width: 150px;
    height: 150px;
    border-radius: 150px;
}
.c-cards_title h1 {
    font-size: 1.25em;
    margin: 15px 0;
    color: #242424;
}
.c-cards_text {
    display: flex;
    align-items: center;
    justify-content: center;
}
.c-cards_text p {
    font-size: .9em;
    line-height: 1.4em;
    text-align: center;
    width: 90%;
    overflow: hidden;
    overflow: auto;
    height: 120px;
    color: #242424;
}
.c-cards_button .button {
    margin-bottom: 1.5em;
    background-color: #FAB770;
    padding: 10px 17.5px;
    border: none;
    border-radius: 10px;
    color: #242424;
    font-size: 0.9em;
} */
</style>

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
                    <button class="button">
                        Show more
                    </button>
                </div>

            </div>
        <?php endforeach; ?>
        
        </div>
    </section>
</section>