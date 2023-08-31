<?php
declare(strict_types=1);

Class DocumentRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function checkAttachment(int $elementId, int $actorId): string {
        $result = $this->db->query("SELECT * FROM documents WHERE us_id = :actor_id AND id = :did", ["actor_id" => $actorId, "did" => $elementId]);

        return $result ? 'attached' : 'Not attached';
    }

    public function changeStatus(int $elementId, int $actorId, int $statusId): string {
        $result = $this->db->query("UPDATE documents SET status_id = :status_id, us_id = :actor_id WHERE id = :did", ["status_id" => $statusId, "actor_id" => $actorId, "did" => $elementId]);
        return $result ? 'changed' : 'Not changed';
    }

    public function addDocument(): string
    {
        $result = $this->db->query("INSERT INTO documents (us_id, doc_name, file_name, data_blob, status_id) VALUES (:p_us_id, :p_doc_name, :p_file_name, :data_BLOB, 'new')", ["p_us_id" => $userId, "p_doc_name" => $uploadType, "p_file_name" => $_FILES['upload_doc']['name'], "data_BLOB" => $fileContent]);
        return $result ? 'uploaded' : 'Error upload doc';
    }
}