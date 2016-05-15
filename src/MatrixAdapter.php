<?php

namespace com\peterbodnar\qrcoder;

use BaconQrCode\Encoder\ByteMatrix;
use com\peterbodnar\mx\IMatrix;



/**
 * Qrcode Matrix Adapter
 *
 * @internal
 */
class MatrixAdapter implements IMatrix {


	/** @var ByteMatrix */
	protected $byteMatrix;


	/**
	 * QrMatrix constructor.
	 *
	 * @param ByteMatrix $byteMatrix
	 */
	public function __construct(ByteMatrix $byteMatrix) {
		$this->byteMatrix = $byteMatrix;
	}


	/**
	 * @inheritdoc
	 * @return int
	 */
	public function getRows() {
		return $this->byteMatrix->getHeight();
	}


	/**
	 * @inheritdoc
	 * @return int
	 */
	public function getColumns() {
		return $this->byteMatrix->getWidth();
	}


	/**
	 * @inheritdoc
	 * @return mixed
	 */
	public function getValue($rowIndex, $columnIndex) {
		return $this->byteMatrix->get($columnIndex, $rowIndex);
	}

}
