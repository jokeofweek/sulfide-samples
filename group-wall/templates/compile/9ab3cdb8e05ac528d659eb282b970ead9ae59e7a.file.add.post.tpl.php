<?php /* Smarty version Smarty-3.0.8, created on 2011-06-17 15:32:34
         compiled from "D:\Websites\Sulfide Samples\group-wall\templates\add.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210214dfb7392aac5a4-51624380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ab3cdb8e05ac528d659eb282b970ead9ae59e7a' => 
    array (
      0 => 'D:\\Websites\\Sulfide Samples\\group-wall\\templates\\add.post.tpl',
      1 => 1308324753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210214dfb7392aac5a4-51624380',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<DIV class="post">
			<FORM id="post-form" method="post" action="/posts/add">
				<?php if (isset($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
				<DIV id="error-box"><SPAN class="error"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</SPAN><BR/></DIV>
				<?php }?>
<LABEL for="author">Author: </LABEL><BR/>
				<INPUT id="author" name="author" type="text"/><BR/>
				<LABEL for="text">Text: </LABEL><BR/>
				<TEXTAREA id="text" name="text" rows=5></TEXTAREA><BR/>
				<INPUT id="submit" name="submit" value="Submit" type="submit"/><BR/>
			</FORM>
			<IMG src="/assets/images/ruler.png" height="2" width="400"/>
		</DIV>
	