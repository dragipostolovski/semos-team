# Project CarClubMK - WordPress
16 Февруару 2024

## ЗАДАЧА

Да се креира едноставна WordPress тема (CarClubMK). Да се креира ‘git repository’ и сработеното да се прикачи на Github / Gitlab. Треба да се креира локална инстанца од WordPress и непотребните фајлови да се стават во ‘.gitignore’. Да се креира фолдер за темата и да се стават стандардните фајлови кои WordPress ги користи за да ја препознае истата.

## Инструкции
- Git: Да се креира празно ‘repository’ на Github или Gitlab. ( CarClubMK )
- Laragon: Да се креира празен проект во локална околина на вашиот компјутер и да се клонира тоа ‘repository’.
- WordPress: Да се додаде WordPress инстанца. wordpress.org
- Инсталација: Да се инсталира WordPress.
- .gitignore: Непотребните фајлови да се изигнорираат.
- Тема: Да се креира темата и да се додадат потребните фајлови.
- Име на темата: CarClubMK ( Text Doman: carclubmk )
- Да се додадат ‘Template Files’ за препознавање на почетната страна, постовите и страниците ( single.php, front-page.php, page.php ).
- Да се додаде 'style.css'
- Да се користи style.scss и да се инсталира 'Live Sass Compiler'
- Да се направи секција 'beginner' која ќе прикаже низа од елементи. Секцијата има header дел кој ќе има наслов и текст пред и после насловот.
- Да се направи навигација во header.php
- Да се креира низа од работиници. Со foreach да се помине низата и да се прикажат податоците за секој елемент.
- Да се направи функција која ке споредува години помеѓу два работника и резултатот да се прикаже на екран (дали првиот работник е постар од вториот работник).

## single.php

- Да се изгради single.php и да се прикаже целата содржина.
- Да се додаде цел HTML DOM и да се додадат три секции: header, main, footer
- Да се додата header.php и footer.php и да се вклучат со get_header() и - get_footer() во single.php.

```
<!-- END  -->
```

# Задачи:
28.02.2024

## За сите:

1. Да се клонира ова 'repository'. Ако веќе го имате клонирано тогаш само git pull origin master.
2. Да креирате нов 'branch' со 'git checkout -b feature/opis-na-branch' од овој облик.
3. Кога ќе завршите со работа: git add . | git commit -m "opis" | git push origin feature/opis-na-branch
4. Во фолдерот 'sections' да се креира фајл со вашето име од овој облик.
```
- filip-v1.php
- stefan-v1.php
- slobodanka-v1.php
```
2. Во core/theme-setup.php да се додадат со 'require_once'.
3. Во front-page.php да се искористи 'get_template_part'.
4. Во секој од вашите фајлоци да се креира низа од елементи. Низата да биде асоцијативна што знаци треба да има клучови/индекси.
```
 'title' => 'Audi',
```
5. Да се креира секција слична на begginer-v1.php без 'headline'.

## Следно:
Treba da креирате свој фајл со вашето име во /core/zаdaci
```
filip.php
nikola.php
```
Со require_once да се повикаат во theme-setup.php
Кодот треба да се додаде во вашиот фајл.

### Слободанка:

wp_head - action hook
Да се искористи овој hook и да се прикаже style во head тагот кој ќе постави боја на позадина на body тагот.
```
<style>
    body {
        background: #fafbfc;
    }
</style>
```
- [wp_head](https://developer.wordpress.org/reference/hooks/wp_head/)

### Никола:
- page-courses.php треба да изгледа како page.php само што во courses да се прикаже the_excerpt();
- Да се искористи the_excerpt филтер и да се додадат на крај три точки ( ... ).
- Edit page и од десната страна треба да се пополни содржина за excerpt-от.
- [the_excerpt](https://developer.wordpress.org/reference/hooks/the_excerpt/)

### Димитар:
- the_title filter hook
- Да се додате текст пред насловот на page-courses.php
- Да се искористи условот !is_admin() && is_page('page-courses')
- [the_title](https://developer.wordpress.org/reference/hooks/the_title/)


### Ружица:

Во functions.php да се креира функција која ќе врати кој од два броја е поголем.
Функцијата треба да прими два параметри: broj1, broj2. Да се прикаже резултат во front-page.php со 'echo' од овој облик: Од $broj1 и broj2 поголем е (се повикува функицјата која ќе го прикаже бројот).
- [functions](https://www.php.net/manual/en/functions.user-defined.php)

### Сандра:
- the_date filter hook
- Да се искористи овој филтер и да се додаде теџт пред датата кој гласи 'Date:' и се додава датата.
- првиот параметар ти е потребен само.
- Во index.php страната за постовите може да тестираш.
[the_date](https://developer.wordpress.org/reference/hooks/the_date/)

### Филип:
- Да се регистрира ново мени во 'theme_setup_functions' со 'register_nav_menus'.
- Менито нека се вика 'settings'
- Да се доврши тоа што го почнавме на час за 'wp_nav_menu'. Да се прикаже менито 'settings' во 'header' тагот. Container нека биде 'nav' таг.
- [wp_nav_menu](https://developer.wordpress.org/reference/functions/wp_nav_menu/)

### Кристијан:
- the_content - filter hook
- Да се искористи овој hook и да се прикаже форма за регистрација после содржината во page-account.php.
- Да се искористи is_page('page-account') функицјата која враќа true или false и да се постави услов да се смени содржината само на тој page.
- Пример има во functions.php: 
```
if( !is_admin() && is_single() )
```
```
<form>
  
</form>
```
- [the_content](https://developer.wordpress.org/reference/hooks/the_content/)

### Викторија:
- the_title filter hook
- Да се додате текст пред насловот page.php
- Да се искористи условот !is_admin() && is_page()
- [the_title](https://developer.wordpress.org/reference/hooks/the_title/)

### Стефан:
- wp_footer - action hook
- Да се искористи овој hook и да се прикаже форма за претплатување (Subscribe) во footer-ot (wp_footer()).
- Да се искористи is_home() функицјата која враќа true или false и да се постави услов за таа форма да се покаже само во index.php.
- Пример има во functions.php: 
```
function ccmk_your_function() {
    echo 'This is inserted at the bottom';
}
// add_action( 'wp_footer', 'ccmk_your_function' );
```
```
<form>
  <input type="text" name="email" id="email" />
  <button type="submit">Subscribe</button>
</form>
```
- [wp_footer](https://developer.wordpress.org/reference/hooks/wp_footer/)

### Александар:

- wp_footer - action hook
- Да се искористи овој hook и да се прикаже теџт: 'Copyright 2024'.
- Да се искористи is_front_page() функицјата која враќа true или false и да се постави услов за таа текст да се покаже само на почетната страна.
- Пример има во functions.php: 
```
if( is_front_page() )

add_action( 'wp_footer', 'ccmk_your_function' );
```
- [wp_footer](https://developer.wordpress.org/reference/hooks/wp_footer/)

### Илија:
- the_title filter hook
- Да се додате текст пред насловот на секој пост во index.php
- Да се искористи условот !is_admin() && is_home()
- [the_title](https://developer.wordpress.org/reference/hooks/the_title/)

```
ПРОБАЈТЕ ДА ГИ РЕШИТЕ ЗАДАЧИТЕ И НА ДРУГИТЕ, ИСКОРИСТЕТЕ ГО ВАШИОТ ФАЈЛ
```