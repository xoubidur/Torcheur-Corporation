<div id="login_form">	<h1>Login Form</h1>	<?php echo form_open('login/login_user'); ?>	<input type="text" name="username" value="Username" />	<input type="password" name="password" value="Password" />	<input type="submit" value="Login" />	</form>	<?php echo anchor('login/signup', 'Create an account'); ?></div>