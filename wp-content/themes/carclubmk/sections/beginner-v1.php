<?php
    $cards = array(
        array( 
            'title' => 'Audi',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ),
        array(
            'title' => 'Chevrolet',
            'desc' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        ),
        array(
            'title' => 'Ford',
            'desc' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        ),
        array(
            'title' => 'Golf',
            'desc' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
        ),
    );

?>

<section class="s-beginner">
    <div class="s-beginner__inner">

        <div class="c-headline container">
            <div class="c-headline__before">
                START YOUR CARS JOURNEY
            </div>
            <h2 class="c-headline__main">
                Beginner's Corner
            </h2>
            <div class="c-headline__after">
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>

        <div class="c-cards">
            <div class="c-cards__inner container">

                <?php foreach( $cards as $card ): 
                
                    $title = $card['title'];
                    $desc = $card['desc']; ?>

                    <div class="c-cards__card">
                        <div class="c-cards_card-header"></div>
                        <div class="c-cards_card-body">
                            <h3 class="c-cards_card-title">
                                <?php echo $card['title']; ?>
                            </h3>
                            <div class="c-cards_card-desc">
                                <?php echo $desc; ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>

    </div>
</section>