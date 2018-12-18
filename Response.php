<?php

namespace Common\Traits;

trait Response
{
    // region Flags
    protected $as_json=false;
    // endregion Flags

    protected
        $code=500,
        $title="Unauthorized action",
        $description="",
        $meta=[],
        $parameters=[];

    /**
     * @return mixed
     */
    public function getCode ()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode ( $code )
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle ( $title )
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription ( $description )
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeta ()
    {
        return $this->meta;
    }

    /**
     * @param mixed $meta
     */
    public function setMeta ( $meta )
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParameters ()
    {
        return $this->parameters;

    }

    /**
     * @param mixed $parameters
     */
    public function setParameters ( $parameters )
    {
        $this->parameters = $parameters;
        return $this;
    }

    protected function buildTitle( $options=[] ){
        if( !empty( $options ) ){
            $this->setResponse ( $options );
        }

        return [
            "code" => $this->code,
            "title" => $this->title,
            "description" => $this->description,
            "meta" => $this->meta,
            "parameters" => $this->parameters,
        ];
    }

    public function setResponse( $options ){
        $this->code = (isset($options['code']) ? $options['code'] : $this->code );
        $this->title = (isset($options['title']) ? $options['title'] : $this->title );
        $this->description = (isset($options['description']) ? $options['description'] : $this->description );
        $this->meta = (isset($options['meta']) ? $options['meta'] : $this->meta );
        $this->parameters = (isset($options['parameters']) ? $options['parameters'] : $this->parameters );

        return $this;
    }

    public function getResponse( $options=[] ){
        if( $this->as_json === true ){
            return response()->json($this->buildTitle());
        }

        return $this->buildTitle( $options );
    }

    public function asJson( $flag=true ){
        $this->as_json = $flag;

        return $this;
    }

    // region Behavioral

    /**
     * @param Response $other
     * @return Response
     */
    public function absorb( $other ){
        return $this->setResponse ( $other->getResponse ( ) );
    }

    public function isError(){
        return ! $this->isSuccess() ;
    }

    public function isSuccess(){
        return ($this->code >= 200 && $this->code <= 299);
    }
    // endregion Behavioral

}
