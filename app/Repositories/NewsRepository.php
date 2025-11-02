<?php
class NewsRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 根據 ID 查找單一新聞
     * 對應 require_news_detailed.php
     */
    public function findById(int $id, int $userId): ?array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM demo_news WHERE id = :id AND userid = :userid AND indicate = 1"
        );
        $stmt->execute(['id' => $id, 'userid' => $userId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * 查找上一篇新聞
     * 對應 require_news_detailed.php
     */
    public function findPrevious(int $id, string $lang, int $userId): ?array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM demo_news WHERE id < :id AND lang = :lang AND indicate = 1 AND userid = :userid ORDER BY id DESC LIMIT 1"
        );
        $stmt->execute(['id' => $id, 'lang' => $lang, 'userid' => $userId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * 查找下一篇新聞
     * 對應 require_news_detailed.php
     */
    public function findNext(int $id, string $lang, int $userId): ?array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM demo_news WHERE id > :id AND lang = :lang AND indicate = 1 AND userid = :userid ORDER BY id ASC LIMIT 1"
        );
        $stmt->execute(['id' => $id, 'lang' => $lang, 'userid' => $userId]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * 搜尋並分頁顯示新聞
     * 對應 require_news_home.php
     */
    public function searchPaginated(string $keyword, string $lang, int $userId, int $page = 0, int $perPage = 8): array {
        $offset = $page * $perPage;
        $searchTerm = '%' . $keyword . '%';

        $sql = "SELECT * FROM demo_news 
                WHERE ((title LIKE :term) OR (type LIKE :term) OR (postdate LIKE :term) OR (author LIKE :term)) 
                AND indicate = 1 AND lang = :lang AND userid = :userid 
                ORDER BY sortid ASC, id DESC 
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':term', $searchTerm, PDO::PARAM_STR);
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $items = $stmt->fetchAll();

        // 取得總筆數
        $countSql = "SELECT count(*) FROM demo_news 
                     WHERE ((title LIKE :term) OR (type LIKE :term) OR (postdate LIKE :term) OR (author LIKE :term)) 
                     AND indicate = 1 AND lang = :lang AND userid = :userid";
        $countStmt = $this->pdo->prepare($countSql);
        $countStmt->execute(['term' => $searchTerm, 'lang' => $lang, 'userid' => $userId]);
        $total = $countStmt->fetchColumn();

        return [
            'items' => $items,
            'total' => (int)$total,
            'totalPages' => ceil($total / $perPage)
        ];
    }

    /**
     * 獲取首頁顯示的新聞列表
     * 對應 require_news_index.php
     */
    public function findForIndex(string $lang, int $userId, int $limit = 10): array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM demo_news WHERE indicate = 1 AND lang = :lang AND userid = :userid ORDER BY id DESC LIMIT :limit"
        );
        $stmt->bindValue(':lang', $lang, PDO::PARAM_STR);
        $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}