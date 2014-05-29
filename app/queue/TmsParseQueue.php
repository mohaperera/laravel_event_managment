<?php

class TmsParseQueue
{

    /**
     * Starts the given job, with the given data.
     *
     * @param Illuminate\Queue\Jobs\Job $job
     * @param array $data
     */
    public function fire($job, $data)
    {
        Artisan::call(
            'tms:parse',
            [
                '--alias' => $data['alias'],
                '--notify' => $data['email'],
                '--keep' => '',
            ]
        );

        if ($job != null) {
            $job->delete();
        }
    }
}

