<?php

return array(
	'error_'.\Upload::UPLOAD_ERR_OK						=> 'Le fichier a été transféré avec succès',
	'error_'.\Upload::UPLOAD_ERR_INI_SIZE				=> 'Le fichier dépasse la directive upload_max_filesize du php.ini',
	'error_'.\Upload::UPLOAD_ERR_FORM_SIZE				=> 'Le fichier dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML',
	'error_'.\Upload::UPLOAD_ERR_PARTIAL				=> 'Le fichier n\'a été que partiellement transféré',
	'error_'.\Upload::UPLOAD_ERR_NO_FILE				=> 'Aucun fichier n\'a été transféré',
	'error_'.\Upload::UPLOAD_ERR_NO_TMP_DIR				=> 'Le répertoire temporaire d\'upload spécifié dans la configuration n\'existe pas',
	'error_'.\Upload::UPLOAD_ERR_CANT_WRITE				=> 'Échec de l\'écriture du fichier',
	'error_'.\Upload::UPLOAD_ERR_EXTENSION				=> 'Le transfert a été bloqué par une extension PHP',
	'error_'.\Upload::UPLOAD_ERR_MAX_SIZE				=> 'Le fichier soumis dépasse la taille maximum autorisée',
	'error_'.\Upload::UPLOAD_ERR_EXT_BLACKLISTED		=> 'Le transfert de fichiers avec cette extension n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_EXT_NOT_WHITELISTED	=> 'Le transfert de fichiers avec cette extension n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_TYPE_BLACKLISTED		=> 'Le transfert de fichiers de ce type n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_TYPE_NOT_WHITELISTED	=> 'Le transfert de fichiers de ce type n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_MIME_BLACKLISTED		=> 'Le transfert de fichiers de ce type mime n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_MIME_NOT_WHITELISTED	=> 'Le transfert de fichiers de ce type mime n\'est pas autorisé',
	'error_'.\Upload::UPLOAD_ERR_MAX_FILENAME_LENGTH	=> 'Le nom du fichier soumis dépasse la longueur maximale autorisée',
	'error_'.\Upload::UPLOAD_ERR_MOVE_FAILED			=> 'Impossible de déplacer le fichier transféré vers son répertoire de destination',
	'error_'.\Upload::UPLOAD_ERR_DUPLICATE_FILE 		=> 'Un fichier portant le même nom que le fichier soumis existe déjà.',
	'error_'.\Upload::UPLOAD_ERR_MKDIR_FAILED			=> 'Impossible de créer le répertoire de destination du fichier soumis.',
);
