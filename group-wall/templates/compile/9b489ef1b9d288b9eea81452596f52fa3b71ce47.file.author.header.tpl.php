<?php /* Smarty version Smarty-3.0.8, created on 2011-06-17 02:32:12
         compiled from "D:\Websites\Sulfide Samples\group-wall\templates\author.header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136984dfabcac6ae8d3-57628443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b489ef1b9d288b9eea81452596f52fa3b71ce47' => 
    array (
      0 => 'D:\\Websites\\Sulfide Samples\\group-wall\\templates\\author.header.tpl',
      1 => 1308277930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136984dfabcac6ae8d3-57628443',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
		<H3>Posts by <?php echo $_smarty_tpl->getVariable('author')->value;?>
 - <A href="/author/<?php echo $_smarty_tpl->getVariable('author')->value;?>
/json">JSON Format</A></H3><BR/>
		<IMG src="/assets/images/ruler.png" height="2" width="400"/>