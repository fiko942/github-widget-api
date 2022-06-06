<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $appname; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $icon ?>">
    <meta name="description" content="">
    <meta name="keywords" content="wiji, fiko, teren, fiko, tobel, github, widget, github widget, wiji fiko teren, fiko teren, wiji fiko, fiko tobel, tobel, trucatt, tobelsoft">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="author" content="Wiji Fiko Teren">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/landing-page.css?q=' . $random_string); ?>">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="bg-img"></div>
    <div class="container">
        <section id="home">
            <div class="font-monospace text-center fs-2 first-primary-text mt-5"><?= trim(htmlspecialchars($appname)); ?></div>
            <div class="font-monospace text-center fs-4 second-primary-text mt-2">Animated Github Widget Javascipt API</div>
            <!-- Data diri start -->
            <div class="row d-flex justify-content-center dd mt-5 align-items-center">
                <!-- Support -->
                <div class="col-lg-3">
                    <a href="https://tobelsoft.my.id/support" target="_blank" class="coffe justify-content-center align-items-center d-flex"><i class='bx bxs-coffee-alt'></i><span class="font-monospace fs-5">Buy me a coffe</span></a>
                </div>
                <!-- Github -->
                <div class="col-lg-3">
                    <a href="https://github.com/fiko942" target="_blank" class="gh row d-flex justify-content-center align-items-center">
                        <div class="col-sm-4 left">
                            <img src="https://avatars.githubusercontent.com/u/84434815?s=400&u=8fccf8966c483cf72524067bd1dc8c20df8945e9&v=4" alt="Wiji Fiko Teren" title="Wiji Fiko Teren">
                        </div>
                        <div class="col-sm-8 right">
                            <i class='bx bxl-github' ></i><span class="font-monospace fs-5">fiko942</span>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="https://resume.tobelsoft.my.id" target="_blank" class="d-flex col-lg-7 justify-content-center align-items-center fs-5 font-monospace resume"><i class='bx bx-search-alt-2' ></i><span>Find out more about me</span></a>
                </div>
            </div>
            <!-- Data diri end -->
            <button class="scrolltodown" alt="Documentation" title="Documentation">
                <i class='bx bxs-chevrons-down fs-1'></i>
            </button>
        </section>
        <section id="docs">
            <div class="font-monospace text-center fs-2 first-p mb-3">Documentation</div>
            <div class="table-responsive">
              <table class="table table-bordered table-dark table-hover table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Parameter</th>
                      <th scope="col">Description</th>
                      <th scope="col">Type</th>
                      <th scope="col">Script Tag Example</th>
                      <th scope="col">Method</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">                    
                    <tr>
                      <th scope="row">1</th>
                      <td><kbd>u</kbd></td>
                      <td><kbd>u</kbd> is a <kbd>Github username</kbd>, You can enter anyone's username on github.</td>
                      <td>Required</td>
                      <td><kbd><?= htmlspecialchars('<script src="'.base_url('wiji-fiko-teren/api.js?u=fiko942').'"></script>') ?></kbd></td>
                      <td>GET</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td><kbd>p</kbd></td>
                      <td><kbd>p</kbd> is a <kbd>Position</kbd>, is the position of the widget on the screen. valid position: <kbd>top-left</kbd>, <kbd>top-right</kbd>, <kbd>bottom-left</kbd>, <kbd>bottom-right</kbd>. if you do not provide a valid value then the position will be set to <kbd>top-right</kbd>.</td>
                      <td>Optional</td>
                      <td><kbd><?= htmlspecialchars('<script src="'.base_url('wiji-fiko-teren/api.js?u=fiko942&p=top-right').'"></script>') ?></kbd></td>
                      <td>GET</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td><kbd>d</kbd></td>
                      <td><kbd>d</kbd> is a <kbd>Description</kbd>, Description is the text under your name. by default description contains the <kbd>bio</kbd> value of your github profile. You can change this using the <kbd>d</kbd> variable. if this method does not work, you can read documentation number <kbd>4</kbd>.</td>
                      <td>Optional</td>
                      <td><kbd><?= htmlspecialchars('<script src="'.base_url('wiji-fiko-teren/api.js?u=fiko942&p=top-right&d=Hello World').'"></script>') ?></kbd></td>
                      <td>GET</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td><kbd>cd</kbd></td>
                      <td><kbd>cd</kbd> is a <kbd>Custom Description</kbd>, you can only fill <kbd>boolean</kbd> data type on this variable. if you fill true, and you fill in the variable description, it will display a custom description in under your name. if you do not fill in a valid value in this variable then this variable contains <kbd>false</kbd>.</td>
                      <td>Optional</td>
                      <td><kbd><?= htmlspecialchars('<script src="'.base_url('wiji-fiko-teren/api.js?u=fiko942&p=top-right&d=Hello World&cd=true').'"></script>') ?></kbd></td>
                      <td>GET</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td><kbd>pw</kbd></td>
                      <td><kbd>pw</kbd> is a <kbd>Personal Website</kbd>, You can enter your website or your company's website in this variable. the website in this variable will be opened when you click on the name or description in the widget. by default this variable contains <kbd><?= base_url(); ?></kbd>.</td>
                      <td>Optional</td>
                      <td><kbd><?= htmlspecialchars('<script src="'.base_url('wiji-fiko-teren/api.js?u=fiko942&p=top-right&d=Hello World&cd=true&pw=https://tobelsoft.my.id/support').'"></script>') ?></kbd></td>
                      <td>GET</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </section>
       
    </div>
    <section id="footer">
        <div class="font-monospace getit fs-5 d-flex justify-content-center align-items-center text-light">Copyright &copy; 2022 <a href="https://resume.tobelsoft.my.id" target="_blank" class="link-info" style="margin-left: 10px;">Wiji Fiko Teren</a></div>
    </section>
    <script src="<?= base_url('vendor/jquery.js') ?>"></script>
    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/landing-page.js?q=' . $random_string); ?>"></script>
    <script>
        $(() => {
            $('.bg-img').css('cssText', `
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url("<?= base_url('assets/imgs/cyberpunk-2077-night-city-cdpr.jpg'); ?>");
                width: 100% !important;
                height: 100vh !important;
                margin: 0;
                padding: 0;
                position: fixed;
                overflow: hidden;
                opacity: .5;
                z-index: -99999;
            `);
        });
    </script>
</body>
</html>