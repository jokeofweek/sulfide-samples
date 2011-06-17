<?php /* Smarty version Smarty-3.0.8, created on 2011-06-17 02:21:54
         compiled from "D:\Websites\Sulfide Samples\group-wall\templates\pagination.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181094dfaba42422227-46989558%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bc54658839837686aa34ad5c46dcd1fca44d1a1' => 
    array (
      0 => 'D:\\Websites\\Sulfide Samples\\group-wall\\templates\\pagination.tpl',
      1 => 1308277313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181094dfaba42422227-46989558',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php if (isset($_smarty_tpl->getVariable('next',null,true,false)->value)){?>
		<A href="/<?php echo $_smarty_tpl->getVariable('controller')->value;?>
/<?php echo $_smarty_tpl->getVariable('action')->value;?>
/<?php echo $_smarty_tpl->getVariable('next')->value;?>
"><< Newer</A> <?php if (isset($_smarty_tpl->getVariable('previous',null,true,false)->value)){?>| <?php }?>
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('previous',null,true,false)->value)){?>
		<A href="/<?php echo $_smarty_tpl->getVariable('controller')->value;?>
/<?php echo $_smarty_tpl->getVariable('action')->value;?>
/<?php echo $_smarty_tpl->getVariable('previous')->value;?>
">Older >></A>
<?php }?>
