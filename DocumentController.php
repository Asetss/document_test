<?php
declare(strict_types=1);
class DocumentController {

    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function actionDocumentUpload(Request $request): Response
    {
        // Тут нужно custom валидация который зависет от флоу типа операции.
        // Например для check_attach нужны поля el_id, actor_id, DOC_SEE_ALL так другими полями.
        // Зависимости от флоу поля должна быть обязательным или не обязательный.

        $document = $this->documentManager->documentUpload($request);

        return response()->json($document);
    }
}
