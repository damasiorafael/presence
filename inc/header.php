<header class="header">
      <nav id="menu-nav" class="menu-nav menu-nav-topo container">
        <h1 class="logo pull-left">
          <a href="index.php">
            <span>Presence Design</span>
          </a>
        </h1>
        <ul>
          <li class="pull-left">
            <a href="index.php" title="INÍCIO" class="<?php if($pagAtiva == "index") echo "menuActive"; ?>">INÍCIO</a>
          </li>
          <li class="pull-left">
            <a href="empresa.php" title="EMPRESA" class="<?php if($pagAtiva == "empresa") echo "menuActive"; ?>">EMPRESA</a>
          </li>
          <li class="pull-left">
            <a href="produtos.php" title="PRODUTOS" class="<?php if($pagAtiva == "produtos") echo "menuActive"; ?>">PRODUTOS</a>
          </li>
          <li class="pull-right contato">
            <a href="contato.php" title="CONTATO" class="<?php if($pagAtiva == "contato") echo "menuActive"; ?>">CONTATO</a>
          </li>
          <li class="pull-right">
            <a href="representantes.php" title="ONDE ENCONTRAR" class="<?php if($pagAtiva == "representantes") echo "menuActive"; ?>">ONDE ENCONTRAR</a>
          </li>
        </ul>
      </nav>
    </header>