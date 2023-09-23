<header>
  <h1 id="header"><?php echo htmlspecialchars($title); ?>DOJA CAT</h1>

  <nav id="menu">
    <ul>
      <li class="<?php echo $nav_home_class; ?>"><a href="/">Home</a></li>
      <li class="<?php echo $nav_form_class; ?>"><a href="/form">Form</a></li>
      <?php if (is_user_logged_in()) { ?>
        <li class="right"><a href="<?php echo logout_url(); ?>">Log Out</a></li>
      <?php } ?>
    </ul>
  </nav>
</header>
