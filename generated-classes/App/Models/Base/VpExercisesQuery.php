<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\VpExercises as ChildVpExercises;
use App\Models\VpExercisesQuery as ChildVpExercisesQuery;
use App\Models\Map\VpExercisesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vp_exercises' table.
 *
 *
 *
 * @method     ChildVpExercisesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVpExercisesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildVpExercisesQuery orderByDayId($order = Criteria::ASC) Order by the day_id column
 *
 * @method     ChildVpExercisesQuery groupById() Group by the id column
 * @method     ChildVpExercisesQuery groupByTitle() Group by the title column
 * @method     ChildVpExercisesQuery groupByDayId() Group by the day_id column
 *
 * @method     ChildVpExercisesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVpExercisesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVpExercisesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVpExercisesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVpExercisesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVpExercisesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVpExercisesQuery leftJoinVpDays($relationAlias = null) Adds a LEFT JOIN clause to the query using the VpDays relation
 * @method     ChildVpExercisesQuery rightJoinVpDays($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VpDays relation
 * @method     ChildVpExercisesQuery innerJoinVpDays($relationAlias = null) Adds a INNER JOIN clause to the query using the VpDays relation
 *
 * @method     ChildVpExercisesQuery joinWithVpDays($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VpDays relation
 *
 * @method     ChildVpExercisesQuery leftJoinWithVpDays() Adds a LEFT JOIN clause and with to the query using the VpDays relation
 * @method     ChildVpExercisesQuery rightJoinWithVpDays() Adds a RIGHT JOIN clause and with to the query using the VpDays relation
 * @method     ChildVpExercisesQuery innerJoinWithVpDays() Adds a INNER JOIN clause and with to the query using the VpDays relation
 *
 * @method     \App\Models\VpDaysQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVpExercises findOne(ConnectionInterface $con = null) Return the first ChildVpExercises matching the query
 * @method     ChildVpExercises findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVpExercises matching the query, or a new ChildVpExercises object populated from the query conditions when no match is found
 *
 * @method     ChildVpExercises findOneById(string $id) Return the first ChildVpExercises filtered by the id column
 * @method     ChildVpExercises findOneByTitle(string $title) Return the first ChildVpExercises filtered by the title column
 * @method     ChildVpExercises findOneByDayId(string $day_id) Return the first ChildVpExercises filtered by the day_id column *

 * @method     ChildVpExercises requirePk($key, ConnectionInterface $con = null) Return the ChildVpExercises by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpExercises requireOne(ConnectionInterface $con = null) Return the first ChildVpExercises matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpExercises requireOneById(string $id) Return the first ChildVpExercises filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpExercises requireOneByTitle(string $title) Return the first ChildVpExercises filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVpExercises requireOneByDayId(string $day_id) Return the first ChildVpExercises filtered by the day_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVpExercises[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVpExercises objects based on current ModelCriteria
 * @method     ChildVpExercises[]|ObjectCollection findById(string $id) Return ChildVpExercises objects filtered by the id column
 * @method     ChildVpExercises[]|ObjectCollection findByTitle(string $title) Return ChildVpExercises objects filtered by the title column
 * @method     ChildVpExercises[]|ObjectCollection findByDayId(string $day_id) Return ChildVpExercises objects filtered by the day_id column
 * @method     ChildVpExercises[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VpExercisesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\VpExercisesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\VpExercises', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVpExercisesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVpExercisesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVpExercisesQuery) {
            return $criteria;
        }
        $query = new ChildVpExercisesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVpExercises|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VpExercisesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VpExercisesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVpExercises A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, day_id FROM vp_exercises WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVpExercises $obj */
            $obj = new ChildVpExercises();
            $obj->hydrate($row);
            VpExercisesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVpExercises|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VpExercisesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VpExercisesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VpExercisesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VpExercisesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpExercisesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpExercisesTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the day_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDayId(1234); // WHERE day_id = 1234
     * $query->filterByDayId(array(12, 34)); // WHERE day_id IN (12, 34)
     * $query->filterByDayId(array('min' => 12)); // WHERE day_id > 12
     * </code>
     *
     * @see       filterByVpDays()
     *
     * @param     mixed $dayId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterByDayId($dayId = null, $comparison = null)
    {
        if (is_array($dayId)) {
            $useMinMax = false;
            if (isset($dayId['min'])) {
                $this->addUsingAlias(VpExercisesTableMap::COL_DAY_ID, $dayId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayId['max'])) {
                $this->addUsingAlias(VpExercisesTableMap::COL_DAY_ID, $dayId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VpExercisesTableMap::COL_DAY_ID, $dayId, $comparison);
    }

    /**
     * Filter the query by a related \App\Models\VpDays object
     *
     * @param \App\Models\VpDays|ObjectCollection $vpDays The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVpExercisesQuery The current query, for fluid interface
     */
    public function filterByVpDays($vpDays, $comparison = null)
    {
        if ($vpDays instanceof \App\Models\VpDays) {
            return $this
                ->addUsingAlias(VpExercisesTableMap::COL_DAY_ID, $vpDays->getId(), $comparison);
        } elseif ($vpDays instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VpExercisesTableMap::COL_DAY_ID, $vpDays->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVpDays() only accepts arguments of type \App\Models\VpDays or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VpDays relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function joinVpDays($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VpDays');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VpDays');
        }

        return $this;
    }

    /**
     * Use the VpDays relation VpDays object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Models\VpDaysQuery A secondary query class using the current class as primary query
     */
    public function useVpDaysQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVpDays($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VpDays', '\App\Models\VpDaysQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVpExercises $vpExercises Object to remove from the list of results
     *
     * @return $this|ChildVpExercisesQuery The current query, for fluid interface
     */
    public function prune($vpExercises = null)
    {
        if ($vpExercises) {
            $this->addUsingAlias(VpExercisesTableMap::COL_ID, $vpExercises->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vp_exercises table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpExercisesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VpExercisesTableMap::clearInstancePool();
            VpExercisesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VpExercisesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VpExercisesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VpExercisesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VpExercisesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VpExercisesQuery
