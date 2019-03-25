<?php

namespace App\Classes;

/**
 * @method string require(array $requires)
 * @method string download(string $releases, string $remote, string $dist)
 * @method string copy(string $shared, string $releases, string $dist)
 * @method string shared(array $shareds)
 * @method string composer(string $releases, string $dist)
 * @method string link(string $releases, string $dist, string $root)
 * @method string chmod(string $shared)
 * @method string chgrp(string $group, string $releases, string $dist)
 */
class Command
{
    /**
     * Collective\Remote connection name
     * 
     * @var string 
     */
    private $connection;

    /**
     * Command constructor
     * 
     * @param string $connection
     */
    public function __construct(string $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Make require directories
     *
     * @param array $requires
     *
     * @return $this
     */
    public function require(array $requires)
    {
        foreach($requires as $dir) {
            \SSH::into($this->connection)->run([
                "[ ! -d $dir ] && mkdir -p $dir"
            ]);
        }
        return $this;
    }

    /**
     * Download project from 'git'
     *
     * @param string $releases
     * @param string $remote
     * @param string $dist
     *
     * @return $this
     */
    public function download(string $releases, string $remote, string $dist) 
    {
        \SSH::into($this->connection)->run([
            "cd $releases && git clone -b master $remote $dist"
        ]);
        return $this;
    }

    /**
     * Copy shared file, or directories to shared directory
     *
     * @param string $shared
     * @param string $releases
     * @param string $dist
     *
     * @return $this
     */
    public function copy(string $shared, string $releases, string $dist)
    {
        \SSH::into($this->connection)->run([
            "[ ! -f $shared/.env ] && cp $releases/$dist/.env.example $shared/.env",
            "[ ! -d $shared/storage ] && cp -R $releases/$dist/storage $shared",
            "[ ! -d $shared/cache ] && cp -R $releases/$dist/bootstrap/cache $shared"        
        ]);
        return $this;
    }

    /**
     * Make shared links
     *
     * @param array $shareds
     *
     * @return $this
     */
    public function shared(array $shareds)
    {
        foreach($shareds as $global => $local) {
            \SSH::into($this->connection)->run([
                "rm -rf $local && ln -nfs $global $local"
            ]);
        }
        return $this;
    }

    /**
     * Composer Install for production
     *
     * @param string $releases
     * @param string $dist
     *
     * @return $this
     */
    public function composer(string $releases, string $dist)
    {
        \SSH::into($this->connection)->run([
            "cd $releases/$dist&& composer install --prefer-dist --no-scripts --no-dev"
        ]);
        return $this;
    }

    /**
     * Make a Document root link to Release directory
     *
     * @param string $releases
     * @param string $dist
     *
     * @return $this
     */
    public function link(string $releases, string $dist, string $root)
    {
        \SSH::into($this->connection)->run([
            "ln -nfs $releases/$dist $root"
        ]);
        return $this;
    }

    /**
     * Change file and directory mode to 775 for shared items
     *
     * @param string $shared
     *
     * @return $this
     */
    public function chmod(string $shared)
    {
        \SSH::into($this->connection)->run([
            "chmod -R 775 $shared/storage",
            "chmod -R 775 $shared/cache"
        ]);
        return $this;
    }

    /**
     * Change a distribution group
     *
     * @param string $releases
     * @param string $dist
     *
     * @return $this
     */
    public function chgrp(string $group, string $releases, string $dist)
    {
        \SSH::into($this->connection)->run([
            "chgrp -h -R $group $releases/$dist"
        ]);
        return $this;
    }
}