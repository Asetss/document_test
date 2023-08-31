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
     *
     * @param string $uploadType
     * @param string$tmpFileName
     * @param int $userId
     * @return bool
     */
    private function uploadDocument(string $uploadType, string $tmpFileName, int $userId): bool {
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
            $this->fileRepository->checkAttachment($request->get('el_id'), $request->get('actor_id'));
        }

        if($this->request->get('operation') === self::OPERATION_TYPE_CHANGE_STATUS) {
            $this->fileRepository->changeStatus($request->get('el_id'), $request->get('actor_id'), $request->get('status_id'));
        }

        if($this->request->get('operation') === self::OPERATION_TYPE_UPLOAD_DOC) {
            $this->uploadDocument($request->get('upload_type'), $request->get('file'), Auth::user()->id);
       }

        return true;
    }
}