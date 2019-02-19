<?php

namespace ArcherZdip\Setting\Console;

use Illuminate\Console\Command;

class SettingGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:get
                            {key : Setting key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a setting value.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $raw = app('setting')->getRaw($this->argument('key'));
        $info = $raw->value;
        if ($raw->whereIn('type', ['array', 'json', 'object', 'collection'])) {
            $info = json_encode($info);
        }

        $this->info($info);
    }
}
