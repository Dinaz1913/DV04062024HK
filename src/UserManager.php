<?php
	
	namespace Warehouse\src;
	
	require_once 'User.php';
	
	class UserManager {
		private array $users = [];
		
		public function __construct() {
			$this->loadUsers();
		}
		
		public function authenticate
		(
			string $username,
		 string $accessCode): bool
		{
			foreach ($this->users as $user) {
				if ($user->getUsername()
					=== $username
					&& $user->getAccessCode()
					=== $accessCode
				)
				{
					return true;
				}
			}
			return false;
		}
		
		private function loadUsers(): void {
			$filePath = __DIR__ . '../User.json';
			if (file_exists($filePath)) {
				$data = json_decode
				(file_get_contents
				($filePath), true);
				foreach ($data['users'] as $userData) {
					$this->users[] = User::fromArray($userData);
				}
			}
		}
	}



