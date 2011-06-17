<?php /* Smarty version Smarty-3.0.8, created on 2011-06-17 02:35:21
         compiled from "D:\Websites\Sulfide Samples\group-wall\templates\post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52674dfabd69394ef6-98803596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df6f575accffd975809a3c3879698dd04288022b' => 
    array (
      0 => 'D:\\Websites\\Sulfide Samples\\group-wall\\templates\\post.tpl',
      1 => 1308278102,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52674dfabd69394ef6-98803596',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
	<DIV class="post">
			<P class="post-text"><?php echo $_smarty_tpl->getVariable('text')->value;?>
</P>
			<H5>Written by: <A href="/author/<?php echo $_smarty_tpl->getVariable('author')->value;?>
" alt="View <?php echo $_smarty_tpl->getVariable('author')->value;?>
's Posts"><?php echo $_smarty_tpl->getVariable('author')->value;?>
</A></H5>
			<H5>Posted on: <?php echo $_smarty_tpl->getVariable('date')->value;?>
</H5>
			<IMG src="/assets/images/ruler.png" height="2" width="400"/>
		</DIV>
	