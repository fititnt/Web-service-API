<?php

/**
 * @package     WebService.Tests
* @subpackage  Application
*
* @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE
*/

/**
 * Test Case class for WebServiceControllerV1JsonContentGet
*
* @package     WebService.Tests
* @subpackage  Application
* @since       1.0
*/
class WebServiceControllerV1JsonContentGetTest extends TestCase
{

	/**
	 * An instance of the class to test.
	 *
	 * @var    WebServiceControllerV1JsonContentGet
	 * @since  1.0
	 */
	private $_instance;

	/**
	 * Tests __construct()
	 *
	 * @return  void
	 *
	 * @covers  WebServiceControllerV1JsonContentGetTest::__construct
	 * @since   1.0
	 */
	public function test__construct()
	{
		// Create the mock.
		$input = $this->getMock('JInput', array('test'), array(), '', false);
		$input->expects($this->any())
		->method('test')
		->will(
				$this->returnValue('ok')
		);

		// Construct the object.
		$controller = new WebServiceControllerV1JsonContentGet($input, $this->getMockWeb());

		// Verify that the values injected into the constructor are present.
		$this->assertEquals('ok', TestReflection::getValue($controller, 'input')->test());
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetOrderData()
	{
		// Input, Expected, Exception
		return array(
				array('', 'asc', true),
				array('asc', 'asc', false),
				array('desc', 'desc', false),
				array(null, 'asc', false),
				array('DESC', 'desc', false),
				array('ASC', 'asc', false),
				array('aSc', 'asc', false),
				array('error', 'desc', true)
		);
	}

	/**
	 * Tests getOrder()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getOrder
	 * @dataProvider  seedGetOrderData
	 * @since         1.0
	 */
	public function testGetOrder($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['order'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getOrder');

		// Clean up after ourselves.
		$_GET['order'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetLimitData()
	{
		// Input, Expected, Exception
		return array(
				array('', null, true),
				array(null, 20, false),
				array('wrong', null, true),
				array(22, 22, false),
				array(150, 100, false),
				array(99, 99, false),
				array(-1, null, true),
				array(0, null, true)
		);
	}

	/**
	 * Tests getLimit()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getLimit
	 * @dataProvider  seedGetLimitData
	 * @since         1.0
	 */
	public function testGetLimit($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['limit'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getLimit');

		// Clean up after ourselves.
		$_GET['limit'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetOffsetData()
	{
		// Input, Expected, Exception
		return array(
				array('', null, true),
				array(null, 0, false),
				array(10, 10, false),
				array(200, 200, false),
				array(-1, null, true)
		);
	}

	/**
	 * Tests getOffset()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getOffset
	 * @dataProvider  seedGetOffsetData
	 * @since         1.0
	 */
	public function testGetOffset($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['offset'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getOffset');

		// Clean up after ourselves.
		$_GET['offset'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetContentIdData()
	{
		// Input, Expected, Exception
		return array(
				array('', '*', false),
				array(null, '*', false),
				array('22', '22', false),
				array('-7', null, true),
				array('22/user', '22', false),
				array('bad/user', '22', true),
				array('-1/user', null, true),
				array('22.json', '22', false),
				array('-1.xml', null, true),
				array('-1.json', null, true),
				array('22/user.json', '22', false)
		);
	}

	/**
	 * Tests getContentId()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getContentId
	 * @dataProvider  seedGetContentIdData
	 * @since         1.0
	 */
	public function testGetContentId($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['@route'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getContentId');

		// Clean up after ourselves.
		$_GET['@route'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetSinceData()
	{
		$date1 = new JDate('1970-01-01');
		$date1 = $date1->toSql();

		$date2 = new JDate('2001-01-01');
		$date2 = $date2->toSql();

		$date3 = new JDate('1999-03-03');
		$date3 = $date3->toSql();

		$date4 = new JDate('now');
		$date4 = $date4->toSql();

		// Input, Expected, Exception
		return array(
				array('', null, true),
				array('1970-01-01', $date1, false),
				array('-0001-01-01', null, true),
				array('2001-01-01', $date2, false),
				array(null, $date1 , false),
				array('99-03-03', $date3 , false),
				array('now', $date4, false)
		);
	}

	/**
	 * Tests getSince()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getSince
	 * @dataProvider  seedGetSinceData
	 * @since         1.0
	 */
	public function testGetSince($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['since'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getSince');

		// Clean up after ourselves.
		$_GET['since'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetBeforeData()
	{
		$date1 = new JDate('1970-01-01');
		$date1 = $date1->toSql();

		$date2 = new JDate('2001-01-01');
		$date2 = $date2->toSql();

		$date3 = new JDate('1999-03-03');
		$date3 = $date3->toSql();

		$date4 = new JDate('now');
		$date4 = $date4->toSql();

		// Input, Expected, Exception
		return array(
				array('', null, true),
				array('1970-01-01', $date1, false),
				array('-0001-01-01', null, true),
				array('2001-01-01', $date2, false),
				array(null, $date4 , false),
				array('99-03-03', $date3 , false),
				array('now', $date4, false)
		);
	}

	/**
	 * Tests getBefore()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getBefore
	 * @dataProvider  seedGetBeforeData
	 * @since         1.0
	 */
	public function testGetBefore($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['before'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getBefore');

		// Clean up after ourselves.
		$_GET['before'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedCheckSupressResponseCodesData()
	{
		// Input, Expected, Exception
		return array(
				array('', null, true),
				array(null, 401, false),
				array('true', 200, false),
				array('false', 401, false),
				array('error', null, true),
				array('TRUE', 200, false),
				array('FALSE', 401, false)
		);
	}

	/**
	 * Tests checkSupressResponseCodes()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::checkSupressResponseCodes
	 * @dataProvider  seedCheckSupressResponseCodesData
	 * @since         1.0
	 */
	public function testCheckSupressResponseCodes($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['suppress_response_codes'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		TestReflection::invoke($this->_instance, 'checkSupressResponseCodes');

		// Clean up after ourselves.
		$_GET['suppress_response_codes'] = null;

		// Verify the value.
		$this->assertEquals($expected, TestReflection::getValue($this->_instance, 'responseCode'));
	}

	/**
	 * Provides test data for request format detection.
	 *
	 * @return  array
	 *
	 * @since   1.0
	 */
	public function seedGetFieldsData()
	{
		// Input, Expected, Exception
		return array(
				array(null, null, false),
				array('', array(), false),
				array('name, surname', array('name','surname'), false),
				array('content, created_at, user_id', array('content','created_at', 'user_id'), false),
		);
	}

	/**
	 * Tests getFields()
	 *
	 * @param   string   $input      Input string to test.
	 * @param   string   $expected   Expected fetched string.
	 * @param   boolean  $exception  True if an InvalidArgumentException is expected based on invalid input.
	 *
	 * @return  void
	 *
	 * @covers        WebServiceControllerV1JsonContentGet::getFields
	 * @dataProvider  seedGetFieldsData
	 * @since         1.0
	 */
	public function testGetFields($input,  $expected, $exception)
	{
		// Set the input values.
		$_GET['fields'] = $input;

		// If we are expecting an exception set it.
		if ($exception)
		{
			$this->setExpectedException('InvalidArgumentException');
		}

		// Execute the code to test.
		$actual = TestReflection::invoke($this->_instance, 'getFields');

		// Clean up after ourselves.
		$_GET['fields'] = null;

		// Verify the value.
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Prepares the environment before running a test.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function setUp()
	{
		parent::setUp();

		$testInput = new JInput;
		$testMock = $this->getMockWeb();
		$this->_instance = new WebServiceControllerV1JsonContentGet($testInput, $testMock);
	}

	/**
	 * Cleans up the environment after running a test.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function tearDown()
	{
		$this->_instance = null;

		parent::tearDown();
	}

}
