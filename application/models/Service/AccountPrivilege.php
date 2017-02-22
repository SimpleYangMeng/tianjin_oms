<?php
/**
 * 账号权限综合处理
 * 
 * @author Daniel Chen
 */
class Service_AccountPrivilege {
	private static $_privilege = NULL;
	private static $_privilegeMap = NULL;
	private static $_privilegeModule = NULL;
	
	/**
	 * Table_AccountPrivilege实例
	 */
	private static function getPrivilegeModel() {
		if (NULL === self::$_privilege) {
			self::$_privilege = new Table_AccountPrivilege ();
		}
		
		return self::$_privilege;
	}
	
	/**
	 * Table_AccountPrivilegeModule实例
	 */
	private static function getPrivilegeModuleModel() {
		if (NULL === self::$_privilegeModule) {
			self::$_privilegeModule = new Table_AccountPrivilegeModule ();
		}
		
		return self::$_privilegeModule;
	}
	
	/**
	 * Table_AccountPrivilegeMap实例
	 */
	private static function getPrivilegeMapModel() {
		if (NULL === self::$_privilegeMap) {
			self::$_privilegeMap = new Table_AccountPrivilegeMap ();
		}
		
		return self::$_privilegeMap;
	}
	/**
	 *[getByField 字段查询]
	 * @param [type] $value [description]
	 * @param  string $field [description]
	 * @param  string $colums[description]
	 * @return[type]        [description]
	 */
	public static function getByField($value, $field = 'privilege_id', $colums = "*")
    {
        $model = self::getPrivilegeModel();
        return $model->getByField($value, $field, $colums);
    }
	/**
	 * 获取缺省状态下子账号权限
	 */
	public static function getDefaultPrivilege($to_admin = FALSE, $customer_priv) {

		$privilegeModel = self::getPrivilegeModel ();
		$privilegeModuleModel = self::getPrivilegeModuleModel ();
		$list = array ();
		// 主账号
		if ($to_admin) {
			$privilege = $privilegeModel->getAllByCondition ( array (
					'to_show' => 1,
					'to_admin' => 1
			) );
			/*
			 * $where['and'] = array('to_show' => 1);
			 * $where['or'] = $customer_priv;
			 * $privilege = $privilegeModel->getByOrWhere($where, '*');
			 */
			foreach ( $privilege as $k => $m ) {
				/*
				 * $type_includes = $m['customer_type_include'];
				 * $typeArr = explode(',',$type_includes);
				 * if(!in_array($customer_type,$typeArr)){
				 * unset($privilege[$k]);
				 * }
				 */
				// 排除不能看到的菜单
				if (! empty ( $customer_priv ) && is_array ( $customer_priv )) {
					$tmp = array ();
					foreach ( $customer_priv as $pk => $pv ) {
						if ($pv != $m[$pk]) {
							$tmp[] = 1;
						} else {
							$tmp[] = 0;
						}
					}
					$tmp = array_unique($tmp);
					if (count ($tmp) == 1 && $tmp[0] == 1) {
						unset ( $privilege[$k] );
					}
				} else {
					unset ( $privilege[$k] );
				}
			}
			$module = $privilegeModuleModel->getAllByCondition ( array (
				//	'to_admin' => 1,
					'to_show' => 1 
			) );
		} else {
			$privilege = $privilegeModel->getAllByCondition ( array (
					'to_account' => 1,
					'to_show' => 1,
			//		'to_assign' => 1 
			));
			foreach ( $privilege as $k => $m ) {
				/*
				 * $type_includes = $m['customer_type_include'];
				 * $typeArr = explode(',',$type_includes);
				 * if(!in_array($customer_type,$typeArr)){
				 * unset($privilege[$k]);
				 * }
				 */
				// 排除不能看到的菜单
				if (! empty ( $customer_priv ) && is_array ( $customer_priv )) {
					$tmp = array ();
					foreach ( $customer_priv as $pk => $pv ) {
						if ($pv != $m[$pk]) {
							$tmp[] = 1;
						} else {
							$tmp[] = 0;
						}
					}
					$tmp = array_unique($tmp);
					if (count ($tmp) == 1 && $tmp[0] == 1) {
						unset ( $privilege[$k] );
					}
				} else {
					unset ( $privilege[$k] );
				}
			}
			$module = $privilegeModuleModel->getAllByCondition ( array (
			//		'to_admin' => 0,
					'to_show' => 1 
			) );
		}
		
		if ($module && $privilege) {
			$list = self::combinePrivilege ( $module, $privilege );
		}
		return $list;
	}
	
	/**
	 * 获取可用于分配的权限
	 */
	public static function getAssignedPrivilege() {
		$privilegeModel = self::getPrivilegeModel ();
		$privilegeModuleModel = self::getPrivilegeModuleModel ();
		$list = array ();
		$privilege = $privilegeModel->getAllByCondition ( array (
				'to_admin' => 0,
				'to_show' => 1,
				'to_assign' => 1 
		) );
		$module = $privilegeModuleModel->getAllByCondition ( array (
				'to_admin' => 0,
				'to_show' => 1,
				'to_assign' => 1 
		) );
		
		if ($module && $privilege) {
			$list = self::combinePrivilege ( $module, $privilege );
		}
		return $list;
	}
	
	/**
	 * 获取可用于分配的权限ID映射
	 *
	 * 模块ID => array(权限ID, 权限ID, ...)
	 */
	public static function getAssignedPrivilegeIdMap() {
		$privilegeModel = self::getPrivilegeModel ();
		$privilegeModuleModel = self::getPrivilegeModuleModel ();
		$list = array ();
		$privilege = $privilegeModel->getAllByCondition ( array (
				'to_admin' => 0,
				'to_show' => 1,
				'to_assign' => 1 
		) );
		$module = $privilegeModuleModel->getAllByCondition ( array (
				'to_admin' => 0,
				'to_show' => 1,
				'to_assign' => 1 
		) );
		
		if ($module && $privilege) {
			// 提取可供用模块ID
			foreach ( $module as $key => $item ) {
				$module[$key] = ( int ) $item['module_id'];
			}
			
			// 模块ID与权限ID映射
			foreach ( $privilege as $item ) {
				if (! in_array ( ( int ) $item['module_id'], $module, TRUE )) {
					continue;
				}
				
				$list[( int ) $item['module_id']][] = ( int ) $item['privilege_id'];
			}
		}
		
		return $list;
	}
	
	/**
	 * 获取子账号的权限
	 */
	public static function getAccountPrivilege($id, $customer_priv) {
		$privilegeMapModel = self::getPrivilegeMapModel ();
		$privilegeModuleModel = self::getPrivilegeModuleModel ();
		$privilegeModel = self::getPrivilegeModel ();
		$privilege = $privilegeMapModel->getByAccountId ( $id );
		$list = array ();
		
		// 没有返回结果，说明还未分配权限，使用默认权限
		if (empty ( $privilege )) {
			$list = self::getDefaultPrivilege ( false, $customer_priv );
		} else {
			$module = $privilegeModuleModel->getAllByCondition ( array (
					'to_admin' => 0,
					'to_show' => 1 
			) );
			$default = $privilegeModel->getAllByCondition ( array (
					'to_show' => 1,
					'to_assign' => 0,
					'to_admin' => 0 
			) );
			
			// 合并每个子账号都拥有的权限
			if ($default) {
				$privilege = array_merge ( $privilege, $default );
			}
			
			$list = self::combinePrivilege ( $module, $privilege );
		}
		
		return $list;
	}
	
	/**
	 * 获取分配给子账号的权限
	 */
	public static function getAccountAssignedPrivilege($id) {
		$list = self::getAccountPrivilege ( $id );
		
		foreach ( $list as $key => $item ) {
			// 去除不能分配的模块
			if (isset ( $item['to_assign'] ) && 0 === $item['to_assign']) {
				unset ( $list[$key] );
				continue;
			}
			
			// 去除模块中不能分配的权限
			foreach ( $item['items'] as $k => $v ) {
				if (isset ( $v['to_assign'] ) && 0 === $v['to_assign']) {
					unset ( $item['items'][$k] );
					continue;
				}
			}
			
			$list[$key] = $item;
		}
		
		return $list;
	}
	
	/**
	 * 设置子账号权限
	 */
	public static function setAccountPrivilege($privilege, $account_id, $customer_code) {
		$db = Common_Common::getAdapter ();
		$db->beginTransaction ();
		
		try {
			$account = Service_Account::getByCondition ( array (
					'account_id' => ( int ) $account_id,
					'customer_code' => trim ( $customer_code ) 
			) );
			
			if (! $account) {
				throw new Exception ( '子账号不存在' );
			}
			
			$assignedPrivilege = self::getAssignedPrivilegeIdMap ();
			
			foreach ( $privilege as $module => $rights ) {
				if (! in_array ( $module, array_keys ( $assignedPrivilege ), TRUE )) {
					unset ( $privilege[$module] );
				} else {
					foreach ( $rights as $key => $right ) {
						if (! in_array ( ( int ) $right, $assignedPrivilege[$module] )) {
							unset ( $privilege[$module][$key] );
						}
					}
					
					if (empty ( $privilege[$module] )) {
						unset ( $privilege );
					}
				}
			}
			
			if (empty ( $privilege )) {
				throw new Exception ( '至少需要分配一项权限' );
			}
			
			// 删除原有权限
			$privilegeMapModel = self::getPrivilegeMapModel ();
			$privilegeMapModel->delete ( array (
					'account_id' => ( int ) $account_id 
			) );
			
			// 重新插入权限
			foreach ( $privilege as $module => $rights ) {
				foreach ( $rights as $right ) {
					$privilegeMapModel->insert ( array (
							'account_id' => ( int ) $account_id,
							'privilege_id' => ( int ) $right 
					) );
				}
			}
			
			$db->commit ();
			return TRUE;
		} catch ( Exception $e ) {
			$db->rollBack ();
			return $e->getMessage ();
		}
	}
	
	/**
	 * 权限模块、权限合并重组
	 */
	private static function combinePrivilege($module, $privilege) {
		$lang = Ec_Lang::getInstance ()->getCurrentLanguage (); // 当前语音
		$list = array ();
		
		// 权限先按模块分组
		foreach ( $privilege as $item ) {
			$list[$item['module_id']][] = array (
					'id' => ( int ) $item['privilege_id'],
					'name' => $item['privilege_name'],
					'name_en' => $item['privilege_name_en'],
					'slug' => $item['privilege_slug'],
					'link' => $item['privilege_link'],
					'to_assign' => ( int ) $item['to_assign'],
					'display_name' => ('en_US' === trim ( $lang )) ? $item['privilege_name_en'] : $item['privilege_name'] 
			);
		}
		
		// 权限模块合并重组
		foreach ( $module as $key => $item ) {
			if (isset ( $list[$item['module_id']] )) {
				$module[$key] = array (
						'id' => ( int ) $item['module_id'],
						'name' => $item['module_name'],
						'name_en' => $item['module_name_en'],
						'slug' => $item['module_slug'],
						'link' => $item['module_link'],
						'to_assign' => ( int ) $item['to_assign'],
						'items' => $list[$item['module_id']],
						'display_name' => ('en_US' === trim ( $lang )) ? $item['module_name_en'] : $item['module_name'] 
				);
			}
		}
		
		// 去除没有权限的模块
		foreach ( $module as $key => $item ) {
			if (! isset ( $item['items'] )) {
				unset ( $module[$key] );
			}
		}
		
		$list = $module;
		
		return $list;
	}
}
