<?php

require_once __DIR__ . '/../config/database.php';

class Buku
{

    private $collection;

    public function __construct()
    {
        global $db;
        $this->collection = $db->Buku_Baru;
    }

    // Ambil semua data
    public function getAll()
    {
        return $this->collection->find([], ['sort' => ['_id' => -1]]);
    }

    // Ambil data dengan Pagination & Search
    public function getPaginated($page = 1, $limit = 8, $search = '')
    {
        $filter = [];
        if (!empty($search)) {
            $filter = [
                '$or' => [
                    ['judul' => ['$regex' => $search, '$options' => 'i']],
                    ['penulis' => ['$regex' => $search, '$options' => 'i']],
                    ['genre' => ['$regex' => $search, '$options' => 'i']],
                    ['penerbit' => ['$regex' => $search, '$options' => 'i']]
                ]
            ];
        }

        $skip = ($page - 1) * $limit;
        $options = [
            'skip' => (int) $skip,
            'limit' => (int) $limit,
            'sort' => ['_id' => -1]
        ];

        return $this->collection->find($filter, $options);
    }

    // Hitung total dokumen berdasarkan filter search
    public function countTotal($search = '')
    {
        $filter = [];
        if (!empty($search)) {
            $filter = [
                '$or' => [
                    ['judul' => ['$regex' => $search, '$options' => 'i']],
                    ['penulis' => ['$regex' => $search, '$options' => 'i']],
                    ['genre' => ['$regex' => $search, '$options' => 'i']],
                    ['penerbit' => ['$regex' => $search, '$options' => 'i']]
                ]
            ];
        }

        return $this->collection->countDocuments($filter);
    }

    // Tambah buku
    public function insert($data)
    {
        return $this->collection->insertOne($data);
    }

    // Ambil satu buku
    public function getById($id)
    {
        return $this->collection->findOne([
            '_id' => new MongoDB\BSON\ObjectId($id)
        ]);
    }

    // Update buku
    public function update($id, $data)
    {
        $set = [];
        $unset = [];

        foreach ($data as $key => $value) {
            if ($value === null) {
                $unset[$key] = "";
            } else {
                $set[$key] = $value;
            }
        }

        $updatePayload = [];
        if (!empty($set)) {
            $updatePayload['$set'] = $set;
        }
        if (!empty($unset)) {
            $updatePayload['$unset'] = $unset;
        }

        return $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            $updatePayload
        );
    }

    // Hapus buku
    public function delete($id)
    {
        return $this->collection->deleteOne([
            '_id' => new MongoDB\BSON\ObjectId($id)
        ]);
    }

    public function search($keyword)
    {
        $filter = [
            '$or' => [
                ['judul' => ['$regex' => $keyword, '$options' => 'i']],
                ['penulis' => ['$regex' => $keyword, '$options' => 'i']],
                ['genre' => ['$regex' => $keyword, '$options' => 'i']],
                ['penerbit' => ['$regex' => $keyword, '$options' => 'i']]
            ]
        ];

        return $this->collection->find($filter, ['sort' => ['_id' => -1]]);
    }

    public static function calculateFinalPrice($harga, $diskon = 0)
    {
        if (empty($harga)) {
            return null;
        }

        $diskon = (float) ($diskon ?? 0);
        if ($diskon > 0) {
            return $harga - ($harga * $diskon / 100);
        }

        return $harga;
    }
}
