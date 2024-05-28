<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM categories");
    }

    public function testTransaction()
    {
        DB::transaction(function () {
            DB::insert("INSERT INTO categories(id, name, description, created_at) VALUES (?, ?, ?, ?)", [
                "GADGET", "Gadget", "Gadget Category", "2024-01-01 00:00:00"
            ]);
            DB::insert("INSERT INTO categories(id, name, description, created_at) VALUES (?, ?, ?, ?)", [
                "FOOD", "Food", "Food Category", "2024-01-01 00:00:00"
            ]);
        });

        $result = DB::select("SELECT * FROM categories");
        self::assertEquals(2, count($result));
    }

    public function testManualTransaction()
    {
        try {
            DB::beginTransaction();
            DB::insert("INSERT INTO categories(id, name, description, created_at) VALUES (?, ?, ?, ?)", [
                "GADGET", "Gadget", "Gadget Category", "2024-01-01 00:00:00"
            ]);
            DB::insert("INSERT INTO categories(id, name, description, created_at) VALUES (?, ?, ?, ?)", [
                "FOOD", "Food", "Food Category", "2024-01-01 00:00:00"
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $result = DB::select("SELECT * FROM categories");
        self::assertEquals(2, count($result));
    }
}