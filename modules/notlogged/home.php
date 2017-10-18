        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1>Welcome to WebMessenger</h1>
                <p>Please login or register to use our service</p>
                <form action="?act=auth" method="POST">
                  <table>
                    <tr>
                      <td align="right">E-mail:</td>
                      <td align="left"><input type="text" name="email" /></td>
                    </tr>
                    <tr>
                      <td align="right">Password:</td>
                      <td align="left"><input type="password" name="password" /></td>
                    </tr>
                  </table>
                  <input type="submit" value="Login">
                </form>
                <a href="?page=register"> Register </a>
                </br><a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>
            </div>
        </div>
        <!-- /#page-content-wrapper -->