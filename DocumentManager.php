<?php
declare(strict_types=1);
class DocumentManager
{
    private const OPERATION_TYPE_CHECK_ATTACH = 'check_attach';
    private const OPERATION_TYPE_CHANGE_STATUS = 'change_status';
    private const OPERATION_TYPE_UPLOAD_DOC = 'upload_doc';
    private DocumentRepository $fileRepository;
    public function __construct(DocumentRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     *  Фукнцию можно раскидать на сервис классы итд.
     *
     * @param string $uploadType
     * @param string$tmpFileName
     * @param int $userId
     * @return bool
     */
    private function uploadDocument(string $uploadType, string $tmpFileName, int $userId): bool {
        if (!$tmpFileName) {
            throw new InvalidArgumentException('Не выбран тип ');
        }

        // тут функция загрузки файла итд
        $fileContent = file_get_contents($tmpFileName);

        return true;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function documentUpload(Request $request): bool
    {

        // незнаю для чего это, но оставил)
        $privs = [];
        $privs['DOC_SEE_ALL'] = true;

        if ($this->request->get('operation') === self::OPERATION_TYPE_CHECK_ATTACH) {
            $this->fileRepository->checkAttachment($_POST["el_id"], $_POST["actor_id"]);
        }

        if($this->request->get('operation') === self::OPERATION_TYPE_CHANGE_STATUS && isset($_POST["status_id"])) {
            $this->fileRepository->changeStatus($_POST["el_id"], $_POST["actor_id"], $_POST["status_id"]);
        }

        if($this->request->get('operation') === self::OPERATION_TYPE_UPLOAD_DOC && isset($_FILES['upload_doc'], $_POST['upload_type'])) {
            $this->uploadDocument($_POST['upload_type'], $_FILES['upload_doc']['tmp_name'], auth('us_id'));
       }

        return true;
    }
}