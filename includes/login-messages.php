<?php
/**
 * Info messages for login page
 *
 * @package mr
 */

/**
 * Collect login/logout info and error messages from URL parameters.
 *
 * @return array<int,array{type:string,text:string}>
 */
if (!function_exists('get_login_messages')) {
function get_login_messages(): array {
		$messages = [];

		// Success / Info
		if (isset($_GET['loggedout'])) {
			$messages[] = [
				'type' => 'success',
				'text' => 'Du wurdest erfolgreich abgemeldet.',
			];
		}

		if (isset($_GET['checkemail'])) {
			switch ($_GET['checkemail']) {
				case 'confirm':
					$messages[] = [
                        'type' => 'info',
                        'text' => 'Bitte prüfe deine E-Mails. Du erhältst in Kürze eine Bestätigungsnachricht.'
                    ];
					break;
				case 'registered':
					$messages[] = [
                        'type' => 'success',
                        'text' => 'Registrierung erfolgreich. Du kannst dich jetzt anmelden.'
                    ];
					break;
				case 'newpass':
					$messages[] = [
                        'type' => 'info',
                        'text' => 'Bitte prüfe deine E-Mails. Du erhältst einen Link zum Zurücksetzen des Passworts.'
                    ];
					break;
				case 'reset':
					$messages[] = [
                        'type' => 'info',
                        'text' => 'Bitte prüfe deine E-Mails. Wenn die Adresse bekannt ist, erhältst du weitere Schritte.'
                    ];
					break;
				default:
					$messages[] = [
                        'type' => 'info',
                        'text' => 'E-Mail-Bestätigung erforderlich. Bitte prüfe dein Postfach.'
                    ];
					break;
			}
		}

		if (isset($_GET['resetpass'])) {
			$messages[] = [
				'type' => 'success',
				'text' => 'Dein Passwort wurde zurückgesetzt. Du kannst dich jetzt anmelden.',
			];
		}

		if (isset($_GET['reauth'])) {
			$messages[] = [
				'type' => 'info',
				'text' => 'Bitte melde dich erneut an, um fortzufahren.',
			];
		}

		if (isset($_GET['noaccess'])) {
			switch ($_GET['noaccess']) {
				case 'admin':
					$messages[] = [
						'type' => 'info',
						'text' => 'Du bist angemeldet, hast aber keinen Zugriff auf den Adminbereich.',
					];
					break;
				case 'portfolio':
					$messages[] = [
						'type' => 'info',
						'text' => 'Einige Projekte sind aus Datenschutzgründen geschützt. Bitte melde dich an, um sie zu sehen.',
					];
					break;
				case 'single':
					$messages[] = [
						'type' => 'info',
						'text' => 'Dieser Inhalt ist geschützt. Bitte melde dich an, um fortzufahren.',
					];
					break;
				default:
					$messages[] = [
						'type' => 'info',
						'text' => 'Dieser Bereich ist geschützt. Bitte melde dich an.',
					];
					break;
			}
		}

		// Errors
		if (isset($_GET['login'])) {
			$login_flag = (string) $_GET['login'];
			if ($login_flag === 'failed') {
				$messages[] = [
                    'type' => 'error',
                    'text' => 'Benutzername oder Passwort ist falsch.'
                ];
			} elseif ($login_flag === 'empty') {
				$messages[] = [
                    'type' => 'error',
                    'text' => 'Bitte gib Benutzername und Passwort ein.'
                ];
			} else {
				$messages[] = [
                    'type' => 'error',
                'text' => 'Anmeldung fehlgeschlagen. Bitte versuche es erneut.'
                ];
			}
		}

		if (isset($_GET['expiredkey']) || isset($_GET['invalidkey'])) {
			$messages[] = [
				'type' => 'error',
				'text' => 'Der Link zum Zurücksetzen ist ungültig oder abgelaufen.',
			];
		}

		// All others
		$known_keys = [
			'login',
			'loggedout',
			'noaccess',
			'checkemail',
			'resetpass',
			'reauth',
			'expiredkey',
			'invalidkey',
		];

		foreach ($_GET as $key => $value) {
			if (str_contains($key, 'login') && ! in_array($key, $known_keys, true)) {
				$messages[] = [
					'type' => 'info',
					'text' => sprintf('Hinweis: Unbekannter Login-Status (%s = %s).', esc_html($key), esc_html($value)),
				];
			}
		}

		return $messages;
	}
}